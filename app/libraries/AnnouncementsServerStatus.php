<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class AnnouncementsServerStatus implements MessageComponentInterface
{
    function onClose(ConnectionInterface $conn){}

    function onError(ConnectionInterface $conn, \Exception $e){}

    public function onOpen(ConnectionInterface $conn, $request = null){}

    function onMessage(ConnectionInterface $from, $msg){
        $msg = explode(' ', $msg);
        $msg[0] = 'pong';
        $from->send(implode(' ', $msg));
        $from->close();
    }
}
