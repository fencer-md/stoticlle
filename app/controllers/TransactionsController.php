<?php

class TransactionsController extends \BaseController {

    public function transactionsListUser() 
    {
        $id = Auth::user()->id;
        $intTrans = TransactionInt::where('user_id', '=', $id)->select('id', 'transaction_direction', 'ammount', 'date')->get();
        $extTrans = TransactionExt::where('user_id', '=', $id)->select('transaction_id', 'transaction_direction', 'ammount', 'date', 'payment_method')->get();
        $moneyAvailable = 0;
        foreach ($intTrans as $transaction) {
        	if ( $transaction->transaction_direction == 'invest' )
	        	$moneyAvailable -= $transaction->ammount;
	        else
	        	$moneyAvailable += $transaction->ammount;
        }

        $data = ['transactions' => $intTrans, 'moneyAvailable' => $moneyAvailable];

        return View::make('user.transaction')->with('data', $data);
    }

    public function userTransactions($uid) 
    {
        $id = User::where('id', '=', $uid);
        $intTrans = TransactionInt::where('user_id', '=', $uid)->select('id', 'transaction_direction', 'ammount', 'date')->get();
        $moneyAvailable = 0;
        foreach ($intTrans as $transaction) {
        	if ( $transaction->transaction_direction == 'invest' )
	        	$moneyAvailable -= $transaction->ammount;
	        else
	        	$moneyAvailable += $transaction->ammount;
        }

        $data = ['transactions' => $intTrans, 'moneyAvailable' => $moneyAvailable];

        return View::make('user.usertransactionslist')->with('data', $data);
    }

    public function receiveMoney()
    {
        $id = Auth::user()->id;
        $intTrans = new TransactionInt;
        $intTrans->ammount = Input::get('recieve_amount');
        $intTrans->transaction_direction = 'recieved';
        $intTrans->date = date('Y-m-d');
        $intTrans->user_id = $id;
        $intTrans->save();

        return Redirect::back();
    }

    public function investMoney() 
    {
        $id = Auth::user()->id;
        $intTrans = new TransactionInt;
        $intTrans->ammount = Input::get('invest_amount');
        $intTrans->transaction_direction = 'invested';
        $intTrans->date = date('Y-m-d');
        $intTrans->user_id = $id;
        $intTrans->save();

        return Redirect::back();
    }

    public function addMoneyToAccount() 
    {
        $id = Auth::user()->id;
        //$intTrans = new TransactionExt;
        //temporary until solve the union issue
        $intTrans = new TransactionInt;
        $intTrans->ammount = Input::get('add_money');
        $intTrans->transaction_direction = 'added to account';
        $intTrans->date = date('Y-m-d');
        $intTrans->user_id = $id;
        $intTrans->save();

        return Redirect::back();
    }

}