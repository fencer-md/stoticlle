<?php

use Illuminate\Console\Command;

class AnnouncementsMailer extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'announcements:mailer';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Start Announcements Mailer worker.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$config = Config::get('announcements-server.mailer');

		// Listen for mailer workers.
		$mailer = 'tcp://'.$config['ip'].':'.$config['port'];
		$this->info('Connecting mailer worker to '.$mailer);
		$context = new ZMQContext();
		$mailerSocket = $context->getSocket(ZMQ::SOCKET_SUB);
		$mailerSocket->connect($mailer);
		$mailerSocket->setSockOpt(ZMQ::SOCKOPT_SUBSCRIBE, "");

		while (true) {
			$msg = $mailerSocket->recv();
			var_dump($msg);
		}
	}

}
