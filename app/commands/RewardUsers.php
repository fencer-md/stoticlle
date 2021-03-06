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
			$days = Config::get('rate.days');
			$dateInvested->modify('+'.$days.' days');
			$formattedDate = $dateInvested->format('Y-m-d H:i:s');
			$currentDate = date('Y-m-d H:i:s');

			if ( $formattedDate <= $currentDate ) {

				$transactions = Transaction::where('user_id', '=', $user->id)->where('transaction_direction', '=', 'invested')->get();
				$transactionsCount = count($transactions);
				if ( count($transactions) == 0 )
					$ammount = 0;
				else
					$ammount = $transactions[$transactionsCount-1]->ammount;

				if ( $user->investor == 0 || ( $user->investor == 1 && $ammount < 1000 ) )
				{
					$lastInvest = Transaction::where('user_id','=',$user->id)->where('transaction_direction','=','invested')->orderBy('id','DESC')->first();

					$reward = new Transaction;
					$reward->ammount = Helper::reward($ammount, $user->cycle_duration, $user->investment_rate);
					$reward->transaction_direction = 'reward';
					$reward->user_id = $user->id;
					$reward->confirmed = 1;
        			$reward->date = date('Y-m-d H:i:s');
					$reward->save();

					$user->investor = 1;
					$user->awarded = 1;
					$user->awaiting_award = 0;
					$user->invested_date = NULL;
					$user->cycle_duration = NULL;
					$user->investment_rate = 0;
					$user->save();

					$user->userMoney->current_available += $reward->ammount + $lastInvest->ammount;
					$user->userMoney->times_won++;
					$user->userMoney->ammount_won += $reward->ammount;
					$user->userMoney->save();

				}
				elseif ( $user->investor == 1 )
				{

					$offer = Offer::where('recipient_id', '=', $user->id)->orderBy('id','DESC')->first();
					if ( $offer != null )
					{
						$rate = $offer->daily_rate;
					}
					else
					{
						$rate = $user->investment_rate;
					}

					$lastInvest = Transaction::where('user_id','=',$user->id)->where('transaction_direction','=','invested')->orderBy('id','DESC')->first();

					$reward = new Transaction;
					$reward->ammount = Helper::reward($ammount, $user->cycle_duration, $rate);
					$reward->transaction_direction = 'reward';
					$reward->user_id = $user->id;
					$reward->confirmed = 1;
        			$reward->date = date('Y-m-d H:i:s');
					$reward->save();

					$user->awarded = 1;
					$user->awaiting_award = 0;
					$user->invested_date = NULL;
					$user->cycle_duration = NULL;
					$user->investment_rate = 0;
					$user->save();

					$user->userMoney->current_available += $reward->ammount + $lastInvest->ammount;
					$user->userMoney->times_won++;
					$user->userMoney->ammount_won += $reward->ammount;
					$user->userMoney->save();

				}

			}
		}
	}

}
