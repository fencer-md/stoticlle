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


        return View::make(
            'announcements.admin.index',
            array(
                'streams' => $streams,
                'announcements' => $announcements,
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

        $announcement = new Announcement($data);
        $announcement->save();

        // Send message to WebSocket server.
        $config = Config::get('announcements-server.broadcast');
        $context = new ZMQContext();
        $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'web-broadcast');
        $socket->connect('tcp://'.$config['ip'].':'.$config['port']);
        $socket->send($announcement->getMessage());

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
     * @deprecated ???
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getCountdown()
    {
        if (!AnnouncementSeries::latest()) {
            Flash::error('Начните серию.');
            return Redirect::to('admin/announcements');
        }

        $counter = AnnouncementCounter::first();
        if (!$counter) {
            $counter = new AnnouncementCounter();
        }
        $endTime = new Carbon();
        $endTime->addMinutes(10);
        $counter->ends_at = $endTime;
        $counter->save();

        // Send email.
        $config = Config::get('announcements-server');
        $mailer = 'tcp://'.$config['mailer']['ip'].':'.$config['mailer']['port'];
        $context = new ZMQContext();
        $mailerSocket = $context->getSocket(ZMQ::SOCKET_REQ);
        $mailerSocket->connect($mailer);
        $mailerSocket->send($endTime->format('Y-m-d H:i:s'));

        Flash::success('Отчет завершится в ' . $endTime->format('H:i:s'));
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
}
