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
		$mailerSocket = $context->getSocket(ZMQ::SOCKET_REP);
		$mailerSocket->bind($mailer);

		while (true) {
			$msg = $mailerSocket->recv();
			$mailerSocket->send('OK');

			$msg = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $msg);

			// Ignore late alerts.
			if (!$msg->isFuture()) {
				continue;
			}

			$users = User::where('announcements', 1)->get();
			foreach ($users as $user) {
				Mail::send('emails.announcement', array('date' => $msg), function($message) use($user)
				{
					$message->to($user->email);
				});
			}
		}
	}

}
