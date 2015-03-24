<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('', 'MapController@output');

Route::get('register', function()
{
	return View::make('user.register');
});
Route::get('login', function()
{
	return View::make('user.login');
});
Route::get('logout', 'SessionsController@destroy');

Route::get('page/{ptitle}', 'ContentController@viewMake');

Route::post('user/store', 'UserController@store');

Route::group(['before' => 'auth'], function()
{
	Route::group(['before' => 'admin'], function() {
		Route::get('user/admin/config/rate', function() {
			return View::make('backend.admin.config.rate');
		});
		Route::post('user/admin/config/rate', 'ConfigController@update');
		Route::get('user/admin/userlist', 'UserController@usersList');
		Route::get('user/admin/userlistnew', 'UserController@usersListNew');
		Route::get('user/admin/investors', 'UserController@usersListInvestors');
		Route::get('user/admin/awarded', 'UserController@usersListAwarded');
		Route::get('user/admin/monitored', 'UserController@usersListMonitored');
		Route::get('user/admin/transactions/{uid}', 'TransactionsController@userTransactions');
		Route::get('user/admin/investments/{uid}', 'TransactionsController@usersInvestedMoney');
		Route::get('user/admin/funds', 'TransactionsController@currentFunding');
		Route::get('user/admin/earned/{uid}', 'TransactionsController@usersEarnedMoney');
		Route::get('user/admin/reward', function()
		{
			return View::make('includes.backend.rewarddialog');
		});
		Route::post('user/admin/reward/{uid}', 'TransactionsController@moneyEarned');
		Route::get('user/admin/rewardlist', 'UserController@rewardList');
		Route::get('user/admin/offer', function()
		{
			return View::make('includes.backend.offerdialog');
		});
		Route::post('user/admin/offer/{uid}', 'OfferController@create');
		Route::get('user/admin/nonactiveusers', 'UserController@usersListAwaiting');
		Route::get('user/admin/nextstepusers', 'UserController@usersListNext');
		Route::get('user/admin/edituserlist', 'UserController@usersList');
		Route::get('user/admin/edituser/{uid}', 'UserController@editUserInfoAdmin');
		Route::get('user/messages/create', function()
		{
			return View::make('backend.admin.messagecreate');
		});
		Route::post('user/messages/create', 'MessageController@create');
		Route::get('user/admin/addmoneyrequests', 'TransactionsController@usersAddMoney');
		Route::get('user/admin/addmoneyrequest', function()
		{
			return View::make('includes.backend.adddialog');
		});
		Route::post('user/admin/addmoneyrequest', 'TransactionsController@addMoneyRequestStatus');
		Route::get('user/admin/moneyrecieved', 'TransactionsController@usersAddMoneyPending');
		Route::post('user/admin/moneyrecieved', 'TransactionsController@addMoneyRequestConfirm');
		Route::get('user/admin/withdrawrequests', 'TransactionsController@usersWithdrawMoney');
		Route::post('user/admin/withdrawrequest', 'TransactionsController@usersWithdrawMoneyConfirm');
		Route::post('user/admin/comment', 'UserController@updateCommentary');
		Route::get('user/admin/denied', 'TransactionsController@userRefusedTransactions');
		Route::get('user/admin/pages', 'ContentController@showPages');
		Route::get('user/admin/page/{pid}', 'ContentController@edit');
		Route::post('user/admin/page/{pid}', 'ContentController@update');
		Route::get('user/admin/blocks/', 'ContentController@showBlocks');
		Route::get('user/admin/block/{bid}', 'ContentController@editBlock');
		Route::post('user/admin/blocks/mb', 'ContentController@updateMainBlock');
		Route::post('user/admin/blocks/b', 'ContentController@updateBlocks');
		Route::post('user/admin/blocks/p', 'ContentController@updatePartners');
		Route::post('user/admin/edit/showdot', 'UserController@showOnMap');
		Route::post('user/admin/edit/showcontinent', 'UserController@showOnMap');

		Route::controller('admin/announcements', 'AnnouncementsController');
	});
    Route::controller('user/announcements', 'UserAnnouncementsController');

	Route::get('user/edit', 'UserController@editUserInfo');
	Route::post('user/edit/update', 'UserController@updateInfo');

	Route::get('user/transactions', 'TransactionsController@transactionsListUser');
	Route::post('user/invest', 'TransactionsController@investMoney');
	Route::get('user/withdraw', 'TransactionsController@withdraw');
	Route::post('user/withdraw', 'TransactionsController@withdrawRequest');
	Route::get('user/addmoney', 'TransactionsController@addMoneyPage');
	Route::post('user/transactions/addmoney', 'TransactionsController@addMoneyToAccount');
	Route::get('user/transactions/cashout', function()
	{
		return View::make('backend.user.cashout');
	});
	Route::post('user/transactions/cashout', 'TransactionsController@cashOutRequest');
	Route::get('user/admin/transaction/commentary', 'TransactionsController@transactionComment');
	Route::post('user/edit/coords', 'UserController@updateCoords');
});

Route::get('user/confirm/{cc}', 'UserController@confirm');

Route::get('language/{lang}', 'LanguageController@index');

Route::resource('session', 'SessionsController');
Route::resource('user', 'SessionsController');
Route::controller('password', 'RemindersController');

View::creator('layouts.backend.base', function($view)
{
	if ( Auth::user()->role == '1' ) {
    	$users = User::where('role', '=', '2')->get();

    	$usersRegistered = count($users);
	    $currentAmmount = 0;
	    $totalAdded = 0;
	    $totalInvested = 0;
	    $totalRewarded = 0;
	    $totalWithdrawn = 0;
	    $totalCycles = 0;

		foreach ($users as $user) {

		    if ( $user->awaiting_award == 1 ) {
				$lastInvestedAmmount = Transaction::where('user_id', '=', $user->id)->where('transaction_direction', '=', 'invested')->where('confirmed', '=', 1)->orderBy('created_at', 'DESC')->first();
				if ( count($lastInvestedAmmount) == 0 )
					$lastInvestedAmmount = 0;
				else
					$lastInvestedAmmount = $lastInvestedAmmount->ammount;
			} else
				$lastInvestedAmmount = 0;

		    $totalAdded += $user->userMoney->ammount_added;
		    $totalInvested += $user->userMoney->ammount_invested;
		    $totalRewarded += $user->userMoney->ammount_won;
		    $totalWithdrawn += $user->userMoney->ammount_withdrawn;
	    	$currentAmmount += $user->userMoney->current_available;
	    	$totalCycles += $user->userMoney->times_won;
		}

		$data = [
			'usersRegistered' => $usersRegistered,
			'currentAmmount' => $currentAmmount,
			'totalInvested' => $totalInvested,
			'totalRewarded' => $totalRewarded,
			'totalCycles' => $totalCycles,
			];

	} elseif ( Auth::user()->role == '2' ) {
	    $uid = Auth::user()->id;
	    $user = User::where('id', '=', $uid)->first();

	    $totalAdded = $user->userMoney->ammount_added;
	    $totalInvested = $user->userMoney->ammount_invested;
	    $totalRewarded = $user->userMoney->ammount_won;
	    $totalWithdrawn = $user->userMoney->ammount_withdrawn;
	    $currentAmmount = $user->userMoney->current_available;

	    if ( $user->awaiting_award == 1 ) {
			$lastInvestedAmmount = Transaction::where('user_id', '=', $uid)->where('transaction_direction', '=', 'invested')->where('confirmed', '=', 1)->orderBy('created_at', 'DESC')->first();
			if ( count($lastInvestedAmmount) == 0 )
				$lastInvestedAmmount = 0;
			else
				$lastInvestedAmmount = $lastInvestedAmmount->ammount;
		} else
			$lastInvestedAmmount = 0;
		$adminUsersRegistered = 0;

		$data = [ 
			'currentAmmount' => $currentAmmount,
			'totalInvested' => $totalInvested,
			'totalRewarded' => $totalRewarded,
			'lastInvestedAmmount' => $lastInvestedAmmount,
			];
	}

	$view->with('data', $data);
});

View::creator('includes.backend.cycles', function($view)
{
	$user = Auth::user();
	$id = $user->id;
	$ammount = 0;

	// Get last investment.
	$transactions = Transaction::where('user_id', '=', $id)->where('transaction_direction', '=', 'invested')->orderBy('id', 'desc')->first();

	if ($transactions) {
		$ammount = $transactions->ammount;
	}

	if ( $user->awaiting_award == 1 && $user->investor != 1 )
	{
	    $data = Helper::reward($ammount, $user->cycle_duration, $user->investment_rate);
	} elseif ( $user->awaiting_award == 1 && $user->investor == 1 && $ammount >= 1000 ) {
		$offer = Offer::where('recipient_id', '=', $id)->orderBy('id','DESC')->first();
		if ( $offer != null ) {
			$rate = $offer->daily_rate;
		} else {
			$rate = $user->investment_rate;
		}
	    $data = Helper::reward($ammount, $user->cycle_duration, $rate);
	} elseif ( $user->awaiting_award == 1 && $user->investor == 1 && $ammount >= 100 ) {
	    $data = Helper::reward($ammount, $user->cycle_duration, $user->investment_rate);
	}

	$view->with('data', $data);
});

View::creator('includes.backend.newoffer', function($view)
{
	$uid = Auth::user()->id;
	$user = User::where('id', '=', $uid)->first();

    $totalAdded = $user->userMoney->ammount_added;
    $totalInvested = $user->userMoney->ammount_invested;
    $totalRewarded = $user->userMoney->ammount_won;
    $totalWithdrawn = $user->userMoney->ammount_withdrawn;
    $userMoneyAvailable = $user->userMoney->current_available;

	$offers = Auth::user()->userOffer;
	$lastInvest = Transaction::where('user_id','=',$uid)->where('transaction_direction','=','invested')->orderBy('id','DESC')->first();
	$offer = count($offers);
	$data = [
		'default_rate' => Config::get('rate.original_rate'),
		'default_period' => Config::get('rate.days'),
		'default_min' => Config::get('rate.min'),
	];

	if ( $offer > 0 && Auth::user()->investor == 1 ) {
		$offer = $offers[$offer-1];

		$currentDate = date('Y-m-d H:i:s');

		if ( Auth::user()->awaiting_award == 0
			 && $currentDate <= $offer->offer_ends
			 && $lastInvest != NULL
			 && $lastInvest->ammount >= 1000 )
		{
			$data['body'] = $offer->body;
			$data['offer_ends'] = $offer->offer_ends;
			$data['rate'] = $offer->rate;
			$data['offers'] = count($offers);
			$data['lastInvest'] = $lastInvest;
		}
	}

	$view->with('data', $data)->with('moneyAvailable', $userMoneyAvailable)->with('lastInvest', $lastInvest);
});

View::creator('backend.user.withdraw', function($view)
{
	$uid = Auth::user()->id;
	$user = User::where('id', '=', $uid)->first();
	
    $totalAdded = $user->userMoney->ammount_added;
    $totalInvested = $user->userMoney->ammount_invested;
    $totalRewarded = $user->userMoney->ammount_won;
    $totalWithdrawn = $user->userMoney->ammount_withdrawn;
    $userMoneyAvailable = ( $totalAdded + $totalRewarded ) - ( $totalInvested + $totalWithdrawn);
	
	$view->with('moneyAvailable', $userMoneyAvailable);
});

View::creator('includes.backend.cycles', function ($view) {
        $uid = Auth::user()->id;
        $lastInvest = Transaction::where('user_id', '=', $uid)
            ->where('transaction_direction', '=', 'invested')
            ->orderBy('id', 'DESC')->first();

        $amount = 0;
        if ($lastInvest) {
            $amount = $lastInvest->ammount;
        }

        $view->with('lastInvestedAmmount', $amount);
    });

View::creator('homepage', function($view)
{
	$blocks = Block::all();

	// TODO: Improve this part. Add validation.
	foreach ($blocks as $block) {
		$block->content = json_decode($block->content);
		}

	$view->with('blocks', $blocks);
});

App::missing(function($exception) {
		return Response::view('errors/404', array(), 404);
});
Route::get('rules', function()
    {
        return View::make('rules');
    });
Route::get('news', function()
    {
        return View::make('news');
    });
Route::get('about-us', function()
    {
        return View::make('about_us');
    });