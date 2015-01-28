<?php

class AnnouncementsController extends BaseController
{
    public function getNew()
    {
        $announcement = Announcement::latest();
        $message = empty($announcement)? null : $announcement->message;
        echo $message;
    }

    public function getIndex()
    {
        $announcements = Announcement::orderBy('id', 'DESC')->get();
        return View::make(
            'announcements.admin.index',
            array(
                'announcements' => $announcements,
            )
        );
    }

    public function getCreate()
    {
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
        // Set expires_at field to "now() + 10 minutes".
        $data->expires_at = $data->freshTimestamp()->addMinutes(10);
        $data->save();

        // Send message to WebSocket server.
        $config = Config::get('announcements-server.broadcast');
        $context = new ZMQContext();
        $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'web-broadcast');
        $socket->connect('tcp://'.$config['ip'].':'.$config['port']);
        $socket->send($data->message);

        return Redirect::to('admin/announcements');
    }

    public function getStatus()
    {
        // Check AnnouncementServer status.
        $config = Config::get('announcements-server.status');
        $statusSocket = 'http://'.$config['ip'].':'.$config['port'];

        $reply = null;
        $payload = md5(microtime());

        set_error_handler(array($this, 'socketError'));
        $reply = file_get_contents($statusSocket.'/?ping='.$payload);
        restore_error_handler();

        echo (int)($reply == 'pong '.$payload);
    }

    protected function socketError(){}
}
