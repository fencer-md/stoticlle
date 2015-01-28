<?php
use Ratchet\Http\HttpServerInterface;

class AnnouncementsServerStatus implements HttpServerInterface
{
    function onClose(\Ratchet\ConnectionInterface $conn){}

    function onError(\Ratchet\ConnectionInterface $conn, \Exception $e){}

    public function onOpen(\Ratchet\ConnectionInterface $conn, \Guzzle\Http\Message\RequestInterface $request = null){
        $payload = $request->getQuery()->get('ping');
        $reply = new \Guzzle\Http\Message\Response(200,array(), 'pong '.$payload);
        $conn->send($reply->getMessage());
        $conn->close();
    }

    function onMessage(\Ratchet\ConnectionInterface $from, $msg){}
}
