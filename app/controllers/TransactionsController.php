<?php
// TODO: Split the file into 2 parts based on admin and user functionality.
class TransactionsController extends \BaseController {

    //---------------Admin---------------

    public function userTransactions($uid) 
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        $controller = 'userTransactions';

        if ( $uid == "all")
        {
            $user = null;
            if ( $sortby && $order )
                $transactions = Transaction::select('users_transaction.id as id', 'users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                             ->where('confirmed', '=', 1)
                                             ->leftJoin('payment_methods', 'users_transaction.from_credentials', '=', 'payment_methods.id' )
                                             ->leftJoin('users', 'users_transaction.user_id', '=', 'users.id' )
                                             ->orderBy($sortby, $order)
                                             ->get();
            else
                $transactions = Transaction::select('users_transaction.id as id', 'users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                             ->where('confirmed', '=', 1)
                                             ->leftJoin('payment_methods', 'users_transaction.from_credentials', '=', 'payment_methods.id' )
                                             ->leftJoin('users', 'users_transaction.user_id', '=', 'users.id' )
                                             ->get();
        } else
        {
            $user = User::where('id', '=', $uid)->first();
            if ( $sortby && $order )
                $transactions = Transaction::select('users_transaction.id as id', 'users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                             ->where('users_transaction.user_id', '=', $uid)
                                             ->where('confirmed', '=', 1)
                                             ->orderBy($sortby, $order)
                                             ->get();
            else
                $transactions = Transaction::select('users_transaction.id as id', 'users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                             ->where('users_transaction.user_id', '=', $uid)
                                             ->where('confirmed', '=', 1)
                                             ->get();
        }

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist', ['transactions' => $transactions, 'user' => $user, 'uid' => $uid, 'sortby' => $sortby, 'order' => $order, 'controller' => $controller]);
    }

    public function userRefusedTransactions() 
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        $controller = 'userRefusedTransactions';
        $uid = null;

        $user = null;
        if ( $sortby && $order )
            $transactions = Transaction::select('users_transaction.id as id', '.users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                   ->where('transaction_direction', '=', 'added(denied)')
                                   ->orWhere('transaction_direction', '=', 'invested(denied)')
                                   ->orWhere('transaction_direction', '=', 'withdraw(denied)')
                                   ->join('payment_methods', 'users_transaction.from_credentials', '=', 'payment_methods.id' )
                                   ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                   ->orderBy($sortby, $order)
                                   ->get();
        else
            $transactions = Transaction::select('users_transaction.id as id', '.users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                   ->where('transaction_direction', '=', 'added(denied)')
                                   ->orWhere('transaction_direction', '=', 'invested(denied)')
                                   ->orWhere('transaction_direction', '=', 'withdraw(denied)')
                                   ->join('payment_methods', 'users_transaction.from_credentials', '=', 'payment_methods.id' )
                                   ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                   ->get();

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist', ['transactions' => $transactions, 'user' => $user, 'uid' => $uid, 'sortby' => $sortby, 'order' => $order, 'controller' => $controller]);
    }

    public function currentFunding() 
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        $controller = 'currentFunding';
        $uid = null;

        $user = null;
        if ( $sortby && $order )
            $transactions = Transaction::select('users_transaction.id as id', '.users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                         ->where('transaction_direction', '=', 'added')
                                         ->where('confirmed', '=', 1)                                         
                                         ->join('payment_methods', 'users_transaction.from_credentials', '=', 'payment_methods.id' )
                                         ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                         ->orderBy($sortby, $order)->get();
        else
            $transactions = Transaction::select('users_transaction.id as id', '.users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                         ->where('transaction_direction', '=', 'added')
                                         ->where('confirmed', '=', 1)
                                         ->join('payment_methods', 'users_transaction.from_credentials', '=', 'payment_methods.id' )                                         
                                         ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                         ->get();

        $data = ['transactions' => $transactions, 'user' => $user];

        return View::make('backend.admin.usertransactionslist', ['transactions' => $transactions, 'user' => $user, 'uid' => $uid, 'sortby' => $sortby, 'order' => $order, 'controller' => $controller]);
    }

    public function usersInvestedMoney($uid)
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        $controller = 'usersInvestedMoney';

        if ( $uid == "all")
        {
            $user = null;
            if ( $sortby && $order )
                $transactions = Transaction::select('users_transaction.id as id', '.users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                             ->where('transaction_direction', '=', 'invested')
                                             ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                             ->orderBy($sortby, $order)->get();
            else
                $transactions = Transaction::select('users_transaction.id as id', '.users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                             ->where('transaction_direction', '=', 'invested')
                                             ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                             ->get();
        } else
        {
            $user = User::where('id', '=', $uid)->first();
            if ( $sortby && $order )
                $transactions = Transaction::where('transaction_direction', '=', 'invested')
                                             ->orderBy($sortby, $order)->get();
            else
                $transactions = Transaction::where('transaction_direction', '=', 'invested')
                                             ->get();
        }

        return View::make('backend.admin.usertransactionslist', ['transactions' => $transactions, 'user' => $user, 'uid' => $uid, 'sortby' => $sortby, 'order' => $order, 'controller' => $controller]);
    }

    public function usersEarnedMoney($uid)
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        $controller = 'usersEarnedMoney';

        if ( $uid == "all")
        {
            $user = null;
            if ( $sortby && $order )
                $transactions = Transaction::select('users_transaction.id as id', '.users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                             ->where('transaction_direction', '=', 'reward')
                                             ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                             ->orderBy($sortby, $order)->get();
            else
                $transactions = Transaction::select('users_transaction.id as id', '.users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                             ->where('transaction_direction', '=', 'reward')
                                             ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                             ->get();
        } else
        {
            $user = User::where('id', '=', $uid)->first();
            if ( $sortby && $order )
                $transactions = Transaction::select('users_transaction.id as id', '.users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                             ->where('user_id', '=', $uid)
                                             ->where('transaction_direction', '=', 'reward')
                                             ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                             ->orderBy($sortby, $order)->get();
            else
                $transactions = Transaction::select('users_transaction.id as id', '.users_transaction.user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                             ->where('user_id', '=', $uid)
                                             ->where('transaction_direction', '=', 'reward')
                                             ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                             ->get();
        }

        return View::make('backend.admin.usertransactionslist', ['transactions' => $transactions, 'user' => $user, 'uid' => $uid, 'sortby' => $sortby, 'order' => $order, 'controller' => $controller]);
    }

    public function usersAddMoney()
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        $user = null;
        $uid = null;
        $controller = 'usersAddMoney';

        $transactions = Transaction::select('users_transaction.id as id', 'user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                     ->where('transaction_direction', '=', 'added')
                                     ->where('confirmed', '=', '0')
                                     ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                     ->get();

        return View::make('backend.admin.usertransactionslist', ['transactions' => $transactions, 'user' => $user, 'uid' => $uid, 'sortby' => $sortby, 'order' => $order, 'controller' => $controller]);
    }

    public function usersAddMoneyPending()
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        $user = null;
        $uid = null;
        $controller = 'usersAddMoneyPending';

        $transactions = Transaction::select('users_transaction.id as id', 'user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                     ->where('transaction_direction', '=', 'added(pending)')
                                     ->where('confirmed', '=', '0')
                                     ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                     ->get();

        return View::make('backend.admin.usertransactionslist', ['transactions' => $transactions, 'user' => $user, 'uid' => $uid, 'sortby' => $sortby, 'order' => $order, 'controller' => $controller]);
    }

    public function usersWithdrawMoney()
    {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
        $user = null;
        $uid = null;
        $controller = 'usersWithdrawMoney';

        $transactions = Transaction::select('users_transaction.id as id', 'user_id', 'from_credentials', 'date', 'payment_system', 'ammount','transaction_direction')
                                     ->where('transaction_direction', '=', 'withdraw')
                                     ->where('confirmed', '=', '0')
                                     ->join('users', 'users_transaction.user_id', '=', 'users.id' )
                                     ->get();

        return View::make('backend.admin.usertransactionslist', ['transactions' => $transactions, 'user' => $user, 'uid' => $uid, 'sortby' => $sortby, 'order' => $order, 'controller' => $controller]);
    }

    public function moneyEarned() 
    {
        $user = User::where('id', '=', Input::get('uid'))->first();
        $user->awarded = 1;
        $user->awaiting_award = 0;
        $dateInvested = $user->invested_date;
        $user->invested_date = null;
        $user->userMoney->ammount_won += Input::get('reward');
        $user->userMoney->current_available += Input::get('reward');
        $user->userMoney->times_won++;
        $user->userMoney->save();
        $user->save();

        $date = new DateTime($dateInvested);
        $date->modify('-25 days');
        $formatted_date = $date->format('Y-m-d H:i:s');

        $transaction = new Transaction;
        $transaction->ammount = Input::get('return_money');
        $transaction->transaction_direction = 'reward';
        $transaction->comment = '';
        $transaction->date = date('Y-m-d');
        $transaction->user_id = Input::get('uid');
        $transaction->save();

        return Redirect::back();
    }

    public function usersWithdrawMoneyConfirm()
    {
        $transaction = Transaction::where('id', '=' , Input::get('tid'))->first();
        if ( Input::get('status') == 'deny' ) {
            $transaction->transaction_direction = 'withdraw(denied)';
            $transaction->confirmed = 1;
        }
        else
            $transaction->confirmed = 1;
        $transaction->save();

        $user = User::where('id', '=', Input::get('uid'))->first();
        $user->userMoney->ammount_withdrawn += $transaction->ammount;
        $user->userMoney->current_available -= $transaction->ammount;
        $user->userMoney->times_withdrawn++;
        $user->userMoney->save();

        $data = MailHelper::prepareData($user);
        $data += ['ammount' => Input::get('ammount'), 'text' => Input::get('text'), 'credentials' => 'none'];

        Mail::send('emails.addmoneycredentials', $data, function($message) use($user) {
            $message->to($user->email)->subject('Add money request info');
        });

        $user->save();

        return Redirect::back();
    }

    public function addMoneyRequestStatus() 
    {
        $transaction = Transaction::where('id', '=' , Input::get('tid'))->first();
        $transaction->to_credentials = Input::get('credentials');
        if ( Input::get('status') == 'deny' ) {
            $transaction->transaction_direction = 'added(denied)';
            $transaction->confirmed = 1;
            $transaction->comments = Input::get('text');
        }
        else
            $transaction->transaction_direction = 'added(pending)';
        $transaction->save();

        $user = User::where('id', '=', Input::get('uid'))->first();
        $data = MailHelper::prepareData($user);

        $data += ['credentials' => Input::get('credentials'), 'text' => Input::get('text')];

        Mail::send('emails.addmoneycredentials', $data, function($message) use($user) {
            $message->to($user->email)->subject('Add money request info');
        });

        return Redirect::back();
    }

    public function addMoneyRequestConfirm() 
    {
        $transaction = Transaction::where('id', '=' , Input::get('tid'))->first();
        if ( Input::get('status') == 'deny' ) {
            $transaction->transaction_direction = 'added(denied)';
            $transaction->confirmed = 1;
            $transaction->comments = Input::get('text');
        }
        else
            $transaction->transaction_direction = 'added';
        $transaction->confirmed = 1;
        $transaction->save();

        $user = User::where('id', '=', Input::get('uid'))->first();
        $user->userMoney->ammount_added += $transaction->ammount;
        $user->userMoney->current_available += $transaction->ammount;
        $user->userMoney->times_added++;
        $user->userMoney->save();

        $data = MailHelper::prepareData($user);
        $text = 'You successfuly added '.$transaction->ammount.'$';

        $data += ['ammount' => $transaction->ammount, 'text' => $text, 'credentials' => 'none'];

        Mail::send('emails.addmoneycredentials', $data, function($message) use($user) {
            $message->to($user->email)->subject('Add money request info');
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
        $transaction->date = date('Y-m-d H:i:s');
        $transaction->user_id = $id;
        $transaction->save();

        return Redirect::back();
    }

    public function investMoney()
    {
        $uid = Auth::user()->id;

        // Check for custom offer.
        $lastTransaction = Transaction::where('user_id', '=', $uid)
            ->where('transaction_direction', '=', 'invested')
            ->where('ammount', '>=', '1000')
            ->orderBy('created_at', 'DESC')->first();

        // Approve offer.
        if ( $lastTransaction != null && $lastTransaction->confirmed == 0 )
        {
            $lastTransaction->confirmed = 1;
            $lastTransaction->date = date('Y-m-d H:i:s');
            $user = User::where('id', '=', $uid)->first();
            $user->awaiting_award = 1;
            $user->invested_date = date('Y-m-d H:i:s');
            $user->cycle_duration = Config::get('rate.days');
            $user->investment_rate = Config::get('rate.rate');
            $user->userMoney->ammount_invested += $lastTransaction->ammount;
            $user->userMoney->current_available -= $lastTransaction->ammount;
            $user->userMoney->times_invested++;
            $user->userMoney->save();
            $user->save();

            $lastTransaction->user_id = $uid;
            $lastTransaction->save();

            $user = Auth::user();
            $data = MailHelper::prepareData($user);
            $data += ['ammount' => $lastTransaction->ammount];

            Mail::send('emails.invested', $data, function($message) use($user) {
                $message->to($user->email)->subject('Successful transfer!');
            });

            return Redirect::back();
        } elseif ( Input::get('ammount') > Input::get('moneyAvailable')  )
        {
            return Redirect::to('user/addmoney')->with('msg', "You don't have enough money to invest.");
        } else
        {
            // Input validation.
            $rules = [
                'ammount' => ['required', 'numeric', 'min:' . Config::get('rate.min')]
            ];
            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            $transaction = new Transaction;
            $transaction->ammount = Input::get('ammount');
            $transaction->transaction_direction = 'invested';
            if ( Auth::user()->investor == 1 && Input::get('ammount') < 1000 ) {
                $user = User::where('id', '=', $uid)->first();
                $transaction->confirmed = 1;
                $user->userMoney->ammount_invested += Input::get('ammount');
                $user->userMoney->current_available -= Input::get('ammount');
                $user->userMoney->times_invested++;
                $user->userMoney->save();
                $transaction->date = date('Y-m-d H:i:s');
                $user = User::where('id', '=', $uid)->first();
                $user->awaiting_award = 1;
                $user->invested_date = date('Y-m-d H:i:s');
                $user->cycle_duration = Config::get('rate.days');
                $user->investment_rate = Config::get('rate.rate');
                $user->save();
            }
            elseif ( Auth::user()->investor == 1 ) 
            {
                $transaction->confirmed = 0;
            }
            else
            {
                $user = User::where('id', '=', $uid)->first();
                $transaction->confirmed = 1;
                $user->userMoney->ammount_invested += Input::get('ammount');
                $user->userMoney->current_available -= Input::get('ammount');
                $user->userMoney->times_invested++;
                $user->userMoney->save();
                $transaction->date = date('Y-m-d H:i:s');
                $user = User::where('id', '=', $uid)->first();
                $user->awaiting_award = 1;
                $user->invested_date = date('Y-m-d H:i:s');
                $user->cycle_duration = Config::get('rate.days');
                $user->investment_rate = Config::get('rate.rate');
                $user->save();
            }
            $transaction->user_id = $uid;
            $transaction->save();

            $user = Auth::user();
            $data = MailHelper::prepareData($user);

            $data += ['ammount' => $transaction->ammount, 'invested' => 'pending'];

            Mail::send('emails.invested', $data, function($message) use ($user) {
                $message->to($user->email)->subject('Successful transfer!');
            });

            return Redirect::back();
        }
    }

    public function addMoneyPage()
    {
        $uid = Auth::user()->id;
        $accounts = PaymentMethod::select('id', 'title', 'account_id')->where('user_id', '=', $uid)->get();
        $wallets = array();
        foreach ($accounts as $acc) {
            $wallets[$acc->title] = $acc->account_id;
        }

        return View::make('backend.user.addmoney')->with('wallets', $wallets);
    }

    public function addMoneyToAccount() 
    {
        $rules = [
            'add_method' => 'required',
            'add_money' => 'required',
            'credentials' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }

        $uid = Auth::user()->id;

        $wallet = PaymentMethod::where('account_id', '=', Input::get('credentials'))
            ->where('user_id', '=', $uid)
            ->first();

        if ( $wallet == null ) {
            $payment = new PaymentMethod;
            $payment->title = Input::get('add_method');
            $payment->account_id = Input::get('credentials');
            $payment->user_id = $uid;
            $payment->save();
        }

        $transaction = new Transaction;
        $transaction->ammount = Input::get('add_money');
        $transaction->payment_system = Input::get('add_method');
        $transaction->transaction_direction = 'added';
        $transaction->confirmed = 0;
        $transaction->date = date('Y-m-d H:i:s');
        $transaction->user_id = $uid;

        $wallet = PaymentMethod::where('user_id', '=', $uid)->orderBy('created_at', 'DESC')->first();
        $transaction->from_credentials = $wallet->id;

        $transaction->save();


        $user = Auth::user();
        $data = MailHelper::prepareData($user);
        $data['ammount'] = $transaction->ammount;

        Mail::send('emails.moneyadded', $data, function($message) use($user) {
            $message->to($user->email)->subject('Successful transfer!');
        });

        $msg = 'You\'ve requested to add '.Input::get('add_money').'$ to your account, wait for the response.';

        return Redirect::back()->with('msg',$msg);
    }

    public function withdraw()
    {
        $uid = Auth::user()->id;
        $payments = PaymentMethod::where('user_id', '=', $uid)->get();

        return View::make('backend.user.withdraw')->with('payments', $payments);
    }


    public function withdrawRequest()
    {
        if ( Input::get('ammount') > Input::get('moneyAvailable')  )
        {
            return Redirect::to('user/addmoney')->with('msg', 'You don\'t have enough money to withdraw.');
        } else
        {
            $uid = Auth::user()->id;

            $user = User::where('id', '=', $uid)->first();
            $user->investor = 1;
            $user->save();

            $transaction = new Transaction;
            $transaction->ammount = Input::get('ammount');
            $transaction->payment_system = Input::get('withdraw_method');
            $transaction->transaction_direction = 'withdraw';
            $transaction->from_credentials = Input::get('payment_method_id');
            $transaction->confirmed = 0;
            $transaction->date = date('Y-m-d H:i:s');
            $transaction->user_id = $uid;
            $transaction->save();

            return Redirect::back();
        }
    }

    public function transactionComment() {
        $tid = Input::get('tid');
        $transaction = Transaction::select('comments')->where('id', '=', $tid)->first();

        return View::make('includes.backend.transactioncommentary')->with('commentary', $transaction);
    }

    //---------------End users---------------

}