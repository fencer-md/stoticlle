<?php

use Illuminate\Console\Command;
use React\ZMQ\Context as ZMQContext;
use React\Socket\Server as SocketServer;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\Factory as LoopFactory;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

class AnnouncementsServer extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'announcements:server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Announcements WebSocket server.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        // create a log channel
        $log = new Logger('websocket');
        $log->pushHandler(new RotatingFileHandler(storage_path().'/logs/websocket.log', 10, Logger::DEBUG));

        $config = Config::get('announcements-server');
        $loop = LoopFactory::create();
        $announcements = new AnnouncementsWebSocket($log);

        // Listen for the web server to make a message push.
        $broadcast = 'tcp://' . $config['broadcast']['ip'] . ':' . $config['broadcast']['port'];
        $this->info('Starting broadcast socket on ' . $broadcast);
        $context = new ZMQContext($loop);
        $broadcastSocket = $context->getSocket(ZMQ::SOCKET_PULL);
        $broadcastSocket->bind($broadcast);
        $broadcastSocket->on('message', array($announcements, 'onBroadcast'));

        // Listen for status check.
        $status = 'tcp://' . $config['status']['ip'] . ':' . $config['status']['port'];
        $this->info('Starting status socket on ' . $status);
        $statusSock = new SocketServer($loop);
        $statusSock->listen($config['status']['port'], $config['status']['ip']);
        new IoServer(new AnnouncementsServerStatus, $statusSock);

        // Listen for WebSocket connections.
        $wsPort = $config['websocket']['port'];
        $wsIp = $config['websocket']['ip'];
        $this->info('Starting WebSocket socket on ws://' . $wsIp . ':' . $wsPort);
        $webSock = new SocketServer($loop);
        $webSock->listen($wsPort, $wsIp);
        new IoServer(new HttpServer(new WsServer($announcements)), $webSock);

        // Ping all clients each 2 min.
        $loop->addPeriodicTimer(120, function () use ($announcements) {
            $announcements->ping();
        });

        $log->info('Server started');
        $loop->run();
    }

}
