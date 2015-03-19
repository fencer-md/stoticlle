<?php

use Carbon\Carbon;

class AnnouncementsController extends BaseController
{
    /**
     * User: Handle ajax announcements update.
     */
    public function getNew()
    {
        $announcement = Announcement::latest();
        $message = empty($announcement)? null : $announcement->message;
        echo $message;
    }

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
        $announcement->save();

        // Send message to WebSocket server.
        $this->broadcast(array(
            'stream' => $announcement->series_id,
            'type' => 'message',
            'text' => $announcement->getMessage(),
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
    public function getStartCountdown($stream)
    {
        $counter = AnnouncementCounter::getByStream($stream);

        $endTime = new Carbon();
        $endTime->addMinutes(10);
        $counter->ends_at = $endTime;
        $counter->save();

        $this->broadcast(array(
            'stream' => $stream,
            'type' => 'notify',
        ));

        Flash::success('Отчет завершится в ' . $endTime->format('H:i:s'));
        return Redirect::to('admin/announcements');
    }

    /**
     * Admin: Stop stream countdown.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getStopCountdown($stream)
    {
        $counter = AnnouncementCounter::getByStream($stream);

        $endTime = new Carbon();
        $endTime->subSecond();
        $counter->ends_at = $endTime;
        $counter->save();

        Flash::success('Отчет остоновлен');
        return Redirect::to('admin/announcements');
    }

    /**
     * @deprecated ???
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function anyBet()
    {
        $data = Announcement::where('expires_at', '>', new Carbon())->first();

        if (!$data) {
            Flash::error('Нет активных ставок');
            return Redirect::to('user/transactions');
        }

        if (Input::get('bet')) {
            $bet = new AnnouncementBet();
            $bet->announcement_id = $data->id;
            $bet->user_id = Auth::user()->id;
            $bet->amount = Input::get('bet');
            $bet->save();
            Flash::success('Ставка сохранена');
        }

        return View::make(
            'announcements.user.bet',
            array(
                'data' => $data,
            )
        );
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
        $announcement = Announcement::find($id);
        $announcement->success = $value;
        $announcement->save();

        Flash::success('Результат сохранен.');
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
}
