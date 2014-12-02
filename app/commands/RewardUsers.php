<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \DB;
use \Schema;

class RewardUsers extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'users:reward';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Cron to reward users that invested.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$users = User::all();
		foreach ($users as $user) {
			$dateInvested = new DateTime($user->invested_date);
			$dateInvested->modify('+25 days');
			$formattedDate = $dateInvested->format('Y-m-d H:i:s');
			$currentDate = date(('Y-m-d H:i:s'));
			if ( $formattedDate <= $currentDate  )
				echo Config::get('rate.days');
		}
	}

}
