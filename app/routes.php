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

Route::get('/', function()
{
	return View::make('homepage');
});

Route::get('register', function()
{
	return View::make('user.register');
});
Route::get('login', function()
{
	return View::make('user.login');
});
Route::get('logout', 'SessionsController@destroy');

Route::post('user/store', 'UserController@store');

Route::group(['before' => 'auth'], function()
{
	Route::group(['before' => 'admin'], function() {
		Route::get('user/admin/userlist', 'UserController@usersList');
		Route::get('user/admin/userlistnew', 'UserController@usersListNew');
		Route::get('user/admin/investors', 'UserController@usersListInvestors');
		Route::get('user/admin/awarded', 'UserController@usersListAwarded');
		Route::get('user/admin/monitored', 'UserController@usersListMonitored');
		Route::get('user/admin/transactions/{uid}', 'TransactionsController@userTransactions');
		Route::get('user/admin/investments/{uid}', 'TransactionsController@usersInvestedMoney');
		Route::get('user/admin/funds', 'TransactionsController@currentFunding');
		Route::get('user/admin/earned/{uid}', 'TransactionsController@usersEarnedMoney');
		Route::get('user/admin/cashoutlist/{status}', 'TransactionsController@cashOutRequestList');
		Route::post('user/admin/cashout', 'TransactionsController@cashOutRequestStatus');
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
		Route::get('user/admin/moneyrecieved', 'TransactionsController@usersAddMoneyPending');
		Route::post('user/admin/moneyrecieved', 'TransactionsController@addMoneyRequestConfirm');
		Route::get('user/admin/withdrawrequest', 'TransactionsController@usersWithdrawMoney');
		Route::post('user/admin/withdrawrequest', 'TransactionsController@usersWithdrawMoneyConfirm');
	});

	Route::get('user/edit', 'UserController@editUserInfo');
	Route::post('user/edit/update', 'UserController@updateInfo');

	Route::get('user/transactions', 'TransactionsController@transactionsListUser');
	Route::post('user/invest', 'TransactionsController@investMoney');
	Route::get('user/withdraw', 'TransactionsController@withdraw');
	Route::post('user/withdraw', 'TransactionsController@withdrawRequest');
	Route::get('user/addmoney', function()
	{
		return View::make('backend.user.addmoney');
	});
	Route::post('user/transactions/addmoney', 'TransactionsController@addMoneyToAccount');
	Route::get('user/transactions/cashout', function()
	{
		return View::make('backend.user.cashout');		
	});
	Route::post('user/transactions/cashout', 'TransactionsController@cashOutRequest');
	Route::get('user/messages', 'MessageController@messageList');
});

Route::get('user/confirm/{cc}', 'UserController@confirm');

Route::resource('session', 'SessionsController');
Route::resource('user', 'UserController');

View::creator('layouts.backend.base', function($view)
{
    $id = Auth::user()->id;
    $transactions = Transaction::where('user_id', '=', $id)->get();
    $users = User::where('role', '=', '2')->get();
    $userMoneyAvailable = 0;
    foreach ( $transactions as $transaction ) {
    	if ( $transaction->transaction_direction == 'invested' ) {
        	$userMoneyAvailable -= $transaction->ammount;
    	}
        else
        	$userMoneyAvailable += $transaction->ammount;    
	}

    $transactions = Transaction::all();
    $adminUsersRegistered = count($users);
    $adminTotalSum = 0;
    $adminTotalInvestedSum = 0;
    $adminTotalRewardedSum = 0;
    $adminCyclesFinished = 0;
    foreach ( $transactions as $transaction ) {
    	if ( $transaction->transaction_direction == 'invested' && $transaction->confirmed == '1' ) {
        	$adminTotalInvestedSum += $transaction->ammount;
    	}
        elseif ( $transaction->transaction_direction == 'added' && $transaction->confirmed == '1' ) {
        	$adminTotalSum += $transaction->ammount;
        } 
        elseif ( $transaction->transaction_direction == 'reward' && $transaction->confirmed == '1' ) {
        	$adminTotalRewardedSum += $transaction->ammount;
        	$adminCyclesFinished += 1;
        } elseif ( $transaction->transaction_direction == 'withdraw' && $transaction->confirmed == '1' ) {
        	$adminTotalSum -= $transaction->ammount;
        }
	}

	$data = [ 
		'userMoneyAvailable' => $userMoneyAvailable,
		'adminUsersRegistered' => $adminUsersRegistered,
		'adminTotalSum' => $adminTotalSum,
		'adminTotalInvestedSum' => $adminTotalInvestedSum,
		'adminTotalRewardedSum' => $adminTotalRewardedSum,
		'adminCyclesFinished' => $adminCyclesFinished
		];

	$view->with('data', $data);
});

View::creator('includes.backend.cycles', function($view)
{
	$id = Auth::user()->id;
	$transactions = Transaction::where('user_id', '=', $id)->where('transaction_direction', '=', 'invested')->get();
	$transactionsCount = count($transactions);
	$ammount = $transactions[$transactionsCount-1]->ammount;

	if ( Auth::user()->awaiting_award == 1 && $ammount <= 1000 ) 
	{
	    $data = Helper::reward($ammount, 0.02);
	} elseif ( Auth::user()->awaiting_award == 1 && $ammount >= 1000 ) {
		$offer = Offer::where('recipient_id', '=', $id)->orderBy('id','DESC')->first();
		$rate = $offer->rate;
	    $data = Helper::reward($ammount, $rate);
	}

	$view->with('data', $data);
});

View::creator('includes.backend.newoffer', function($view)
{
	$id = Auth::user()->id;
	$offers = Auth::user()->userOffer;
	$lastInvest = Transaction::where('user_id','=',$id)->where('transaction_direction','=','invested')->orderBy('id','DESC')->first();
	$offer = count($offers);
	$offer = $offers[$offer-1];
	$currentDate = date(('Y-m-d H:i:s'));

	if ( Auth::user()->awaiting_award == 0 
		 && $currentDate >= $offer->offer_ends
		 && $lastInvest->ammount >= 1000 )
	{
		$data['body'] = $offer->body;
		$data['offer_ends'] = $offer->offer_ends;
		$data['rate'] = $offer->rate;
	} else $data = null;

	$view->with('data', $data);
});