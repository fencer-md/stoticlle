<?php

class TransactionsController extends \BaseController {

    //---------------Admin---------------

    public function userTransactions($uid) 
    {
        if ( $uid == "all")
        {
            $user = null;
            $transactions = Transaction::all();
        } else
        {
            $user = User::where('id', '=', $uid)->first();
            $transactions = Transaction::where('user_id', '=', $uid)->get();
        }

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);
    }

    public function currentFunding() 
    {
        $user = null;
        $transactions = Transaction::where('transaction_direction', '=', 'invested')->get();

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);
    }

    public function cashOutRequestList() 
    {
        $user = null;
        $transactions = Transaction::where('transaction_direction', '=', 'cash out')->where('confirmed', '=', '0')->get();

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);
    }

    public function usersInvestedMoney($uid)
    {
        if ( $uid == "all")
        {
            $user = null;
            $transactions = Transaction::where('transaction_direction', '=', 'invested')->orWhere('transaction_direction', '=', 'invested(awarded)')->get();
        } else
        {
            $user = User::where('id', '=', $uid)->first();
            $transactions = Transaction::where('user_id', '=', $uid)->where('transaction_direction', '=', 'invested')->where('transaction_direction', '=', 'invested(awarded)')->get();
        }

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);
    }

    public function usersEarnedMoney($uid)
    {
        if ( $uid == "all")
        {
            $user = null;
            $transactions = Transaction::where('transaction_direction', '=', 'earned')->get();
        } else
        {
            $user = User::where('id', '=', $uid)->first();
            $transactions = Transaction::where('user_id', '=', $uid)->where('transaction_direction', '=', 'earned')->get();
        }

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);        
    }

    public function moneyEarned() 
    {
        $user = User::where('id', '=', Input::get('uid'))->first();
        $user->awarded = 1;
        $user->save();

        $transactionInvested = Transaction::where('id', '=', Input::get('tid'))->first();
        $transactionInvested->transaction_direction = 'invested(awarded)';
        $transactionInvested->save();

        $transaction = new Transaction;
        $transaction->ammount = Input::get('return_money');
        $transaction->transaction_direction = 'earned';
        $transaction->transaction_type = 'internal';
        $transaction->date = date('Y-m-d');
        $transaction->user_id = Input::get('uid');
        $transaction->save();

        return Redirect::back();
    }

    //---------------End admin---------------

    //---------------Users---------------

    public function transactionsListUser()
    {
        $id = Auth::user()->id;
        $transactions = Transaction::where('user_id', '=', $id)->get();

        $data = ['transactions' => $transactions];

        return View::make('backend.user.transaction')->with('data', $data);
    }

    public function receiveMoney()
    {
        $id = Auth::user()->id;
        $transaction = new Transaction;
        $transaction->ammount = Input::get('recieve_amount');
        $transaction->transaction_direction = 'recieved';
        $transaction->confirmed = 1;
        $transaction->transaction_type = 'internal';
        $transaction->date = date('Y-m-d H:i:s');
        $transaction->user_id = $id;
        $transaction->save();

        return Redirect::back();
    }

    public function investMoney() 
    {
        $id = Auth::user()->id;
        $user = User::where('id', '=', $id)->first();
        $user->invested_date = date('Y-m-d H:i:s');

        $transaction = new Transaction;
        $transaction->ammount = Input::get('invest_amount');
        $transaction->transaction_direction = 'invested';
        $transaction->confirmed = 1;
        $transaction->transaction_type = 'internal';
        $transaction->date = date('Y-m-d H:i:s');
        $transaction->user_id = $id;
        $transaction->save();

        $email = Auth::user()->email;
        $username = Auth::user()->userInfo->first_name;

        $data = ['username' => $username, 'ammount' => $transaction->ammount];

        Mail::send('emails.invested', $data, function($message) {
            $message->to(Auth::user()->email, 'test')->subject('Successful transfer!');
        });

        return Redirect::back();
    }

    public function addMoneyToAccount() 
    {        
        $id = Auth::user()->id;
        $transaction = new Transaction;
        $transaction->ammount = Input::get('add_money');
        $transaction->payment_method = Input::get('add_method');
        $transaction->transaction_direction = 'added';
        $transaction->confirmed = 1;
        $transaction->transaction_type = 'external';
        $transaction->date = date('Y-m-d H:i:s');
        $transaction->user_id = $id;
        $transaction->save();

        $email = Auth::user()->email;
        $username = Auth::user()->userInfo->first_name;

        $data = ['username' => $username, 'ammount' => $transaction->ammount];

        Mail::send('emails.moneyadded', $data, function($message) {
            $message->to(Auth::user()->email, 'test')->subject('Successful transfer!');
        });

        return Redirect::back();
    }

    public function cashOutRequest()
    {
        $id = Auth::user()->id;
        $transaction = new Transaction;
        $transaction->ammount = Input::get('cash_out_ammount');
        $transaction->transaction_direction = 'cash out';
        $transaction->confirmed = 0;
        $transaction->transaction_type = 'external';
        $transaction->date = date('Y-m-d H:i:s');
        $transaction->user_id = $id;
        $transaction->save();

        return Redirect::back();
    } 

    //---------------End users---------------

}