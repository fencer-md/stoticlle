<?php

class TransactionsController extends \BaseController {

    public function transactionsListUser()
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

        $data = ['transactions' => $transactions, 'moneyAvailable' => $moneyAvailable];

        return View::make('backend.user.transaction')->with('data', $data);
    }

    public function userTransactions($uid) 
    {
        $user = User::where('id', '=', $uid)->first();
        $transactions = Transaction::where('user_id', '=', $uid)->get();
        $moneyAvailable = 0;
        foreach ($transactions as $transaction) {
        	if ( $transaction->transaction_direction == 'invested' )
	        	$moneyAvailable -= $transaction->ammount;
	        else
	        	$moneyAvailable += $transaction->ammount;
        }

        $data = ['transactions' => $transactions, 'moneyAvailable' => $moneyAvailable, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);
    }

    public function receiveMoney()
    {
        $id = Auth::user()->id;
        $transaction = new Transaction;
        $transaction->ammount = Input::get('recieve_amount');
        $transaction->transaction_direction = 'recieved';
        $transaction->transaction_type = 'internal';
        $transaction->date = date('Y-m-d');
        $transaction->user_id = $id;
        $transaction->save();

        return Redirect::back();
    }

    public function investMoney() 
    {
        $id = Auth::user()->id;
        $transaction = new Transaction;
        $transaction->ammount = Input::get('invest_amount');
        $transaction->transaction_direction = 'invested';
        $transaction->transaction_type = 'internal';
        $transaction->date = date('Y-m-d');
        $transaction->user_id = $id;
        $transaction->save();

        return Redirect::back();
    }

    public function addMoneyToAccount() 
    {        
        $id = Auth::user()->id;
        $transaction = new Transaction;
        $transaction->ammount = Input::get('add_money');
        $transaction->payment_method = Input::get('add_method');
        $transaction->transaction_direction = 'added';
        $transaction->transaction_type = 'external';
        $transaction->date = date('Y-m-d');
        $transaction->user_id = $id;
        $transaction->save();

        return Redirect::back();
    }

    public function moneyWon() 
    {        
        $id = Auth::user()->id;
        $transaction = new Transaction;
        $transaction->ammount = Input::get('return_money');
        $transaction->transaction_direction = 'returned';
        $transaction->transaction_type = 'internal';
        $transaction->date = date('Y-m-d');
        $transaction->user_id = Input::get('uid');
        $transaction->save();

        return Redirect::back();
    }

}