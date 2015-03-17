<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class AnnouncementsWebSocket implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Get user's stream. Any connection without user/stream will be closed.
        /* @var $request \Guzzle\Http\Message\EntityEnclosingRequest */
        $request = $conn->WebSocket->request;
        $uid = $request->getQuery()->get('uid');

        if (!$uid) {
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
        } catch (Exception $e) {
            $conn->close();
            return;
        }

        // Store the new connection to send messages to later
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

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
}
