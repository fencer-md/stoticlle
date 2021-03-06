<?php

use Carbon\Carbon;

class AnnouncementsController extends BaseController
{
    /**
     * Admin: Index page.
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $streams = AnnouncementSeries::all();
        $announcements = Announcement::where('success', '=', 0)
            ->orderBy('id', 'desc')->get();

        // Options for stream radio buttons.
        $streamsRadios = [];
        foreach($streams as $stream) {
            $streamsRadios[$stream->id] = $stream->name;
        }

        // Options for announcement type radio buttons.
        $typeRadios = [];
        for($i=1; $i<=3; $i++) {
            $typeRadios[$i] = 'N'.$i;
        }

        // Options for probability radio buttons.
        $probability = ['99.7', '64.7', '33.7', '16.7', '7.7'];
        $probabilityRadios = [];
        foreach($probability as $p) {
            $probabilityRadios[$p] = $p.'%';
        }

        return View::make(
            'announcements.admin.index',
            array(
                'streams' => $streams,
                'announcements' => $announcements,
                'streamsRadios' => $streamsRadios,
                'typeRadios' => $typeRadios,
                'probabilityRadios' => $probabilityRadios,
            )
        );
    }

    /**
     * Admin: Save new announcement.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate()
    {
        $data = Input::all();

        $validator = Validator::make(
            $data,
            array(
                'probability' => 'required',
                'series_id' => 'required',
                'announcement_type' => 'required',
                'name' => 'required',
                'game' => 'required',
                'coefficient' => 'required',
            )
        );

        if ($validator->fails()) {
            Flash::error('Все поля формы обязательны');
            return Redirect::to('admin/announcements')
                ->withInput();
        }

        $announcement = new Announcement($data);
        $expires = new Carbon();
        $expires->addMinutes(10);
        $announcement->expires_at = $expires;
        $announcement->save();

        // Send message to WebSocket server.
        $this->broadcast(array(
            'stream' => $announcement->series_id,
            'type' => 'message',
            'text' => $announcement->getMessage(),
            'ratio' => $announcement->probability,
            'id' => $announcement->id,
        ));

        Flash::success('Анонс сохранен.');
        return Redirect::to('admin/announcements');
    }

    /**
     * Admin: Check announcements server online/offline status.
     */
    public function getServerStatus()
    {
        // Check AnnouncementServer status.
        $config = Config::get('announcements-server.status');
        $reply = null;
        $payload = md5(microtime());

        set_error_handler(array($this, 'socketErrorHandler'));
        $sock = fsockopen($config['ip'], $config['port'], $errono, $errstr, 2);
        if ($sock) {
            fputs($sock, 'ping '.$payload);
            $reply = fgets($sock);
            fclose($sock);
        }
        restore_error_handler();

        echo (int)($reply == 'pong '.$payload);
    }

    /**
     * Prevents showing PHP errors for socket timeout.
     */
    protected function socketErrorHandler(){}

    /**
     * Admin: Start stream countdown.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStartCountdown($stream)
    {
        $counter = AnnouncementCounter::getByStream($stream);
        $name = Input::get('name');

        $endTime = new Carbon();
        $endTime->addMinutes(10);
        $counter->ends_at = $endTime;
        $counter->save();

        $this->broadcast(array(
            'stream' => $stream,
            'type' => 'notify',
            'text' => $name,
            'expires' => $endTime->timestamp,
        ));

        Flash::success('Отчет завершится в ' . $endTime->format('H:i:s'));
    }

    /**
     * Admin: Stop stream countdown.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getStopCountdown($stream)
    {
        $this->stopCounter($stream);

        $this->broadcast(array(
            'stream' => $stream,
            'type' => 'notifyCancel',
        ));

        Flash::success('Отчет остоновлен');
        return Redirect::to('admin/announcements');
    }

    /**
     * Admin: Create new stream page.
     */
    public function getStreamCreate()
    {
        $stream = new AnnouncementSeries();
        return View::make('announcements.admin.stream',
            array('data' => $stream)
        );
    }

    /**
     * Admin: Save new stream.
     */
    public function postStreamCreate()
    {
        $stream = new AnnouncementSeries();
        $stream->name = Input::get('name');
        $stream->save();

        Flash::success('Поток создан.');
        return Redirect::to('admin/announcements');
    }

    /**
     * Admin: Set result for an announcement.
     *
     * @param int $id Announcement ID
     * @param int $value Value see Announcement::SUCCESS, Announcement::FAIL
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getResult($id, $value)
    {
        /* @var $announcement Announcement */
        $announcement = Announcement::find($id);
        $series = $announcement->series_id;

        // Cancel result.
        if ($value == 0) {
            $announcement->delete();

            /* @var $last Announcement */
            $last = Announcement::where('series_id', '=', $series)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->first();

            $broadcast = array(
                'stream' => $series,
                'type' => 'cancelMessage',
                'text' => $last->getMessage(),
                'id' => $id,
            );
            Flash::success('Игра отменена.');
        } else {
            $announcement->success = $value;
            $announcement->save();

            $this->stopCounter($series);

            $broadcast = array(
                'stream' => $series,
                'type' => 'result',
            );
            Flash::success('Результат сохранен.');
        }

        $this->broadcast($broadcast);


        return Redirect::to('admin/announcements');
    }

    /**
     * Send data to websocket server.
     *
     * @param array $data Array with data to be sent to users via websocket.
     *  Mandatory keys are "type" and "stream". Depending on type other fields may be present.
     *  Type "message" must have key 'text'.
     *  Type "notify" has no additional keys.
     */
    protected function broadcast(array $data)
    {
        $config = Config::get('announcements-server.broadcast');
        $context = new ZMQContext();
        $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'web-broadcast');
        $socket->connect('tcp://'.$config['ip'].':'.$config['port']);
        $socket->send(json_encode($data));
    }

    protected function stopCounter($stream)
    {
        $counter = AnnouncementCounter::getByStream($stream);
        $endTime = new Carbon();
        $endTime->subSecond();
        $counter->ends_at = $endTime;
        $counter->save();
    }

    public function postPause($stream)
    {
        $time = Input::get('time');
        $date = new Carbon($time);

        $series = AnnouncementSeries::find($stream);
        $series->paused_until = $date;
        $series->save();

        $this->broadcast(array(
            'stream' => $series,
            'type' => 'pause',
            'date' => $date->getTimestamp(),
        ));
    }
}
