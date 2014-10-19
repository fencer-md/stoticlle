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

Route::get('m', function()
{
	return View::make('backend');
});
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
		Route::get('user/admin/nonactiveusers', 'UserController@usersListAwaiting');
		Route::get('user/admin/edituserlist', 'UserController@usersList');
		Route::get('user/admin/edituser/{uid}', 'UserController@editUserInfoAdmin');
	});

	Route::get('user/edit', 'UserController@editUserInfo');
	Route::post('user/edit/update', 'UserController@updateInfo');

	Route::get('user/transactions', 'TransactionsController@transactionsListUser');
	Route::get('user/invest', function()
	{
		return View::make('backend.user.invest');
	});
	Route::post('user/transactions/invest', 'TransactionsController@investMoney');
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
});

Route::get('user/confirm/{cc}', 'UserController@confirm');

Route::resource('session', 'SessionsController');
Route::resource('user', 'UserController');

View::composer('layouts.backend.base', function($view)
{
    $id = Auth::user()->id;
    $transactions = Transaction::where('user_id', '=', $id)->get();
    $moneyAvailable = 0;
    foreach ($transactions as $transaction) {
    	if ( $transaction->transaction_direction == 'invested' )
        	$moneyAvailable -= $transaction->ammount;
        else
        	$moneyAvailable += $transaction->ammount;
    }

    $view->with('data', $moneyAvailable);
});