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

    public function cashOutRequestList($status) 
    {
        $user = null;
        if ( $status == 'pending' )
            $transactions = Transaction::where('transaction_direction', '=', 'withdraw')->where('confirmed', '=', '0')->get();
        else if ( $status == 'refused' )
            $transactions = Transaction::where('transaction_direction', '=', 'withdraw(failed)')->where('confirmed', '=', '0')->get();

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);
    }

    public function cashOutRequestStatus() 
    {
        $transaction = Transaction::where('id', '=', Input::get('tid') )->first();
        if ( Input::get('status') == '1' )
        {   
            $transaction->confirmed = 1;
            $transaction->transaction_direction = "cash out(approved)";
        } else
        {
            $transaction->confirmed = 0;
            $transaction->transaction_direction = "cash out(failed)";            
        }

        $transaction->save();

        return Redirect::back();
    }

    public function usersInvestedMoney($uid)
    {
        if ( $uid == "all")
        {
            $user = null;
            $transactions = Transaction::where('transaction_direction', '=', 'invested')->get();
        } else
        {
            $user = User::where('id', '=', $uid)->first();
            $transactions = Transaction::where('user_id', '=', $uid)->where('transaction_direction', '=', 'invested')->get();
        }

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);
    }

    public function usersEarnedMoney($uid)
    {
        if ( $uid == "all")
        {
            $user = null;
            $transactions = Transaction::where('transaction_direction', '=', 'reward')->get();
        } else
        {
            $user = User::where('id', '=', $uid)->first();
            $transactions = Transaction::where('user_id', '=', $uid)->where('transaction_direction', '=', 'reward')->get();
        }

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);        
    }

    public function usersAddMoney()
    {
        $user = null;
        $transactions = Transaction::where('transaction_direction', '=', 'added(request)')->where('confirmed', '=', '0')->get();

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);
    }

    public function usersAddMoneyPending()
    {
        $user = null;
        $transactions = Transaction::where('transaction_direction', '=', 'added(pending)')->where('confirmed', '=', '0')->get();

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);
    }

    public function usersWithdrawMoney()
    {
        $user = null;
        $transactions = Transaction::where('transaction_direction', '=', 'withdraw')->where('confirmed', '=', '0')->get();

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist')->with('data', $data);
    }

    public function moneyEarned() 
    {
        $user = User::where('id', '=', Input::get('uid'))->first();
        $user->awarded = 1;
        $user->awaiting_award = 0;
        $dateInvested = $user->invested_date;
        $user->invested_date = null;
        $user->save();

        $date = new DateTime($dateInvested);
        $date->modify('-25 days');
        $formatted_date = $date->format('Y-m-d H:i:s');

        $transaction = new Transaction;
        $transaction->ammount = Input::get('return_money');
        $transaction->transaction_direction = 'reward';
        $transaction->transaction_type = 'internal';
        $transaction->date = date('Y-m-d');
        $transaction->user_id = Input::get('uid');
        $transaction->save();

        return Redirect::back();
    }

    public function usersWithdrawMoneyConfirm() 
    {
        $transaction = Transaction::where('id', '=' , Input::get('tid'))->first();
        $transaction->confirmed = 1;
        $transaction->save();

        $user = User::where('id', '=', Input::get('uid'))->first();

        $email = $user->email;
        $username = $user->userInfo->first_name;

        $data = ['username' => $username, 'ammount' => Input::get('ammount')];

        Mail::send('emails.withdrawconfirm', $data, function($message) {
            $message->to(Auth::user()->email, 'test')->subject('Withdraw!');
        });

        return Redirect::back();
    }

    public function addMoneyRequestStatus() 
    {
        $transaction = Transaction::where('id', '=' , Input::get('tid'))->first();
        $transaction->transaction_id = Input::get('credentials');
        $transaction->transaction_direction = 'added(pending)';
        $transaction->save();

        $user = User::where('id', '=', Input::get('uid'))->first();

        $email = $user->email;
        $username = $user->userInfo->first_name;

        $data = ['username' => $username, 'credentials' => Input::get('credentials')];

        Mail::send('emails.addmoneycredentials', $data, function($message) {
            $message->to(Auth::user()->email, 'test')->subject('credentials!');
        });

        return Redirect::back();
    }

    public function addMoneyRequestConfirm() 
    {
        $transaction = Transaction::where('id', '=' , Input::get('tid'))->first();
        $transaction->transaction_direction = 'added';
        $transaction->confirmed = 1;

        $user = User::where('id', '=', Input::get('uid'))->first();

        $email = $user->email;
        $username = $user->userInfo->first_name;

        $data = ['username' => $username, 'ammount' => $transaction->ammount];

        $transaction->save();

        Mail::send('emails.addmoneyconfirmation', $data, function($message) {
            $message->to(Auth::user()->email, 'test')->subject('Success!');
        });

        return Redirect::back();
    }

    //---------------End admin---------------

    //---------------Users---------------

    public function transactionsListUser()
    {
        $id = Auth::user()->id;
        $transactions = Transaction::where('user_id', '=', $id)->where('confirmed', '=', '1')->get();

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
        if ( Input::get('ammount') > Input::get('moneyAvailable')  )
        {
            return Redirect::to('user/addmoney')->with('msg', 'You don\'t have enough money.');
        } else
        {
            $id = Auth::user()->id;
            $user = User::where('id', '=', $id)->first();
            $user->awaiting_award = 1;
            $user->investor = 1;
            $user->invested_date = date('Y-m-d H:i:s');
            $user->save();

            $transaction = new Transaction;
            $transaction->ammount = Input::get('ammount');
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
    }

    public function addMoneyPage()
    {
        $uid = Auth::user()->id;
        $payments = PaymentMethod::where('user_id', '=', $uid)->get();
        $wallets = [
            'webmoney' => null,
            'paypal' => null,
            'cards' => null,
        ];

        foreach ($payments as $payment) {
            if ( $payment->title == 'webmoney' )
                $wallets['webmoney'] = $payment->account_id;
            elseif ( $payment->title == 'paypal' )
                $wallets['paypal'] = $payment->account_id;
            elseif ( $payment->title == 'cards' )
                $wallets['cards'] = $payment->account_id;
        }

        return View::make('backend.user.addmoney')->with('wallets', $wallets);

    }

    public function addMoneyToAccount() 
    {        
        $uid = Auth::user()->id;
        $transaction = new Transaction;
        $transaction->ammount = Input::get('add_money');
        $transaction->payment_method = Input::get('add_method');
        $transaction->transaction_direction = 'added(request)';
        $transaction->confirmed = 0;
        $transaction->transaction_type = 'external';
        $transaction->date = date('Y-m-d H:i:s');
        $transaction->user_id = $uid;
        $transaction->save();

        if ( Input::get('add_method') == 'webmoney' && Input::get('webmoney') == null )
        {
            $payment = new PaymentMethod;
            $payment->title = 'webmoney';
            $payment->account_id = Input::get('credentials');
            $payment->user_id = $uid;
            $payment->save();
        } elseif ( Input::get('add_method') == 'webmoney' && Input::get('webmoney') != null ) 
        {
            $payment = PaymentMethod::where('user_id', '=', $uid)->where('title', '=', 'webmoney')->first();
            $payment->account_id = Input::get('credentials');
            $payment->save();
        } elseif ( Input::get('add_method') == 'paypal' && Input::get('paypal') == null )
        {
            $payment = new PaymentMethod;
            $payment->title = 'paypal';
            $payment->account_id = Input::get('credentials');
            $payment->user_id = $uid;
            $payment->save();
        } elseif ( Input::get('add_method') == 'paypal' && Input::get('paypal') != null ) 
        {
            $payment = PaymentMethod::where('user_id', '=', $uid)->where('title', '=', 'paypal')->first();
            $payment->account_id = Input::get('credentials');
            $payment->save();
        } elseif ( Input::get('add_method') == 'cards' && Input::get('cards') == null ) 
        {
            $payment = new PaymentMethod;
            $payment->title = 'cards';
            $payment->account_id = Input::get('credentials');
            $payment->user_id = $uid;
            $payment->save();
        } elseif ( Input::get('add_method') == 'cards' && Input::get('cards') != null ) {
            $payment = PaymentMethod::where('user_id', '=', $uid)->where('title', '=', 'cards')->first();
            $payment->account_id = Input::get('credentials');
            $payment->save();
        }

        $email = Auth::user()->email;
        $username = Auth::user()->userInfo->first_name;

        $data = ['username' => $username, 'ammount' => $transaction->ammount];

        Mail::send('emails.moneyadded', $data, function($message) {
            $message->to(Auth::user()->email, 'test')->subject('Successful transfer!');
        });

        return Redirect::back();
    }

    public function withdraw()
    {

        return View::make('backend.user.withdraw');
    }


    public function withdrawRequest()
    {
        $id = Auth::user()->id;
        $transaction = new Transaction;
        $transaction->ammount = Input::get('ammount');
        $transaction->transaction_direction = 'withdraw';
        $transaction->confirmed = 0;
        $transaction->transaction_type = 'external';
        $transaction->date = date('Y-m-d H:i:s');
        $transaction->user_id = $id;
        $transaction->save();

        return Redirect::back();
    }

    //---------------End users---------------

}