<?php

use Carbon\Carbon;

class AnnouncementsController extends BaseController
{
    /**
     * Handle ajax announcements update.
     */
    public function getNew()
    {
        $announcement = Announcement::latest();
        $message = empty($announcement)? null : $announcement->message;
        echo $message;
    }

    public function getIndex()
    {
        $announcements = Announcement::orderBy('id', 'DESC')->get();
        $countdown = AnnouncementCounter::first();
        $countdownEnd = null;
        if ($countdown && $countdown->ends_at->isFuture()) {
            $countdownEnd = $countdown->ends_at->getTimestamp();
        }

        return View::make(
            'announcements.admin.index',
            array(
                'announcements' => $announcements,
                'countdownEnd' => $countdownEnd,
            )
        );
    }

    public function getCreate()
    {
        if (!AnnouncementSeries::latest()) {
            Flash::error('Начните серию.');
            return Redirect::to('admin/announcements');
        }

        if (!AnnouncementCounter::first()->ends_at->isFuture()) {
            Flash::error('Начните отчет.');
            return Redirect::to('admin/announcements');
        }

        $data = new Announcement();
        return View::make(
            'announcements.admin.form',
            array(
                'data' => $data,
            )
        );
    }

    public function postCreate()
    {
        $data = new Announcement(Input::all());
        $series = AnnouncementSeries::latest();
        $counter = AnnouncementCounter::first();
        $data->series_id = $series->id;
        $data->expires_at = $counter->ends_at;
        $data->save();

        // Send message to WebSocket server.
        $config = Config::get('announcements-server.broadcast');
        $context = new ZMQContext();
        $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'web-broadcast');
        $socket->connect('tcp://'.$config['ip'].':'.$config['port']);
        $socket->send($data->message);

        return Redirect::to('admin/announcements');
    }

    /**
     * Check announcements server online/offline status.
     */
    public function getStatus()
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
     * Create new series.
     */
    public function getSeriesStart()
    {
        // Check if another open series exists.
        if (AnnouncementSeries::latest()) {
            Flash::error('Предыдущая серия не была завершена.');
            return Redirect::to('admin/announcements');
        }
        $series = new AnnouncementSeries();
        $series->save();

        Flash::success('Cерия началась.');
        return Redirect::to('admin/announcements');
    }

    /**
     * End current series.
     */
    public function getSeriesEnd()
    {
        $series = AnnouncementSeries::latest();
        $data = Announcement::where('series_id', $series->id)->get();

        return View::make(
            'announcements.admin.series',
            array(
                'data' => $data,
            )
        );
    }
    public function postSeriesEnd()
    {
        $success = Input::get('success', array());
        $ids = array_keys($success);
        Announcement::whereIn('id', $ids)->update(array('success' => true));

        $series = AnnouncementSeries::latest();
        $series->ended_at = new Carbon();
        $series->save();

        Flash::success('Cерия закончилась.');
        return Redirect::to('admin/announcements');
    }

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
}
