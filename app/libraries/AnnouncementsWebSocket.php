<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Monolog\Logger;

class AnnouncementsWebSocket implements MessageComponentInterface {
    protected $clients;
    /**
     * @var Logger
     */
    protected $log;

    public function __construct(Logger $log) {
        $this->clients = new \SplObjectStorage;
        $this->log = $log;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Get user's stream. Any connection without user/stream will be closed.
        /* @var $request \Guzzle\Http\Message\EntityEnclosingRequest */
        $request = $conn->WebSocket->request;
        $uid = $request->getQuery()->get('uid');

        if (!$uid) {
            $this->log->debug('Connection failed: no UID');
            $conn->close();
            return;
        }
        try {
            /* @var $user \User */
            $user = User::findOrFail($uid);
            if (!$user->announcement_stream || ($user->announcement_start && $user->announcement_start->isFuture())) {
                throw new Exception('No stream or start time');
            }

            $conn->WebSocket->announcementStream = $user->announcement_stream;
            $conn->WebSocket->uid = $uid;
        } catch (Exception $e) {
            $this->log->debug('Connection failed: '.$e->getMessage());
            $conn->close();
            return;
        }
        $this->log->debug('User connected: '.$uid);

        // Store the new connection to send messages to later
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
    }

    public function onClose(ConnectionInterface $conn) {
        $this->log->debug('User disconnected: '.$conn->WebSocket->uid);

        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $this->log->debug('Error occurred for user '.$conn->WebSocket->uid.': '.$e->getMessage());

        $conn->close();
    }

    public function onBroadcast($msg) {
        $data = json_decode($msg);
        foreach ($this->clients as $client) {
            if ($client->WebSocket->announcementStream == $data->stream) {
                $client->send($msg);
            }
        }
    }

    public function ping()
    {
        $data = [
            'type' => 'ping',
        ];

        $msg = json_encode($data);
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }
}
