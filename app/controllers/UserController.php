<?php

class UserController extends \BaseController {

	public function store()
 	{
		$rules = array(
			'email' => 'unique:users|required|email'
		);

		$validate = Validator::make( Input::all(), $rules );

		if ( $validate->fails() )
		{
			return Redirect::to('/')
		    	->withErrors($validate)
		        ->withInput();
		}
		else
		{
			$user = new User;
			$userInfo = new UserInfo;
			$userInfo->save();
			$user->user_info_id = $userInfo->id;
			$user->email = Input::get('email');
			$user->role = '2';
			$user->registration_code = str_random(64);
			$password = str_random(12);
			$user->password = Hash::make($password);
			$user->registration_status = '0';
			$user->save();

			$data = ['code' => $user->registration_code, 'password' => $password];
			Mail::send('emails.confirmation', $data, function($message) {
				$message->to(Input::get('email'), 'test')->subject('Welcome!');
			});

			return Redirect::to('/');
		}
 	}

	public function confirm($cc)
	{
		$msg = 'Thank you for registration, you now can login and begin shopping';
		$user = User::where('registration_code', '=', $cc)->first();
		$user->registration_status = 1;
		$user->registration_code = 0;
		$user->save();
		return Redirect::to('/')->with('msg',$msg);
	}

	public function editUserInfo()
	{
		$id = Auth::user()->id;
		$user = User::find($id);
		$user_info = UserInfo::find($user->user_info_id);
		if ( $user_info->birth_date == null )
			$birth_date = null;
		else
			$birth_date = explode("-", $user_info->birth_date);
		$links = json_decode($user_info->links);

		return View::make('backend.user.userinfo', ['user' => $user, 'user_info' => $user_info, 'birth_date' => $birth_date, 'links' => $links]);
	}

	public function editUserInfoAdmin($uid)
	{
		$user = User::find($uid);
		$user_info = UserInfo::find($user->user_info_id);
		if ( $user_info->birth_date == null )
			$birth_date = null;
		else
			$birth_date = explode("-", $user_info->birth_date);

		return View::make('backend.user.userinfo', ['user' => $user, 'user_info' => $user_info, 'birth_date' => $birth_date]);
	}

 	public function updateInfo()
 	{
 		$linksArray = [];
 		for ($i=0; $i < Input::get('links'); $i++) {
 			$temp = $i + 1;
 			$linksArray[$i] = Input::get('link-'.$temp);
 		}
 		$linksArray = json_encode($linksArray);

		$id = Auth::user()->id;
		$user = User::find($id);
		$user_info = UserInfo::find($user->user_info_id);
		$user->password = Hash::make(Input::get('re-password'));
		$user_info->first_name = Input::get('first_name');
		$user_info->last_name = Input::get('last_name');
		$user_info->gender = Input::get('gender');
		$user_info->birth_date = Input::get('birth_date');
		$user_info->country = Input::get('country');
		$user_info->city = Input::get('city');
		$user_info->links = $linksArray;
		$user->save();
		$user_info->save();
		return Redirect::back()->with(['message' => 'updated']);
 	}

 	public function usersList() 
 	{
 		$users = User::select('id', 'email')->where('role', '=', '2')->get();
 		$usersArray = [];
 		$i = 0;

 		foreach ($users as $user) {
	 		$ammountAdded = 0;
	 		$currentAmmount = 0;
	 		$investedTimes = 0;
 			foreach ($user->userTransaction as $transaction) {
	 			if ( $transaction->transaction_direction == 'added' ) {
	 				$ammountAdded += $transaction->ammount;
	 				$currentAmmount += $transaction->ammount;
	 			}
	 			if ( $transaction->transaction_direction == 'invested' ) {
	 				$investedTimes++;
	 				$currentAmmount -= $transaction->ammount;
	 			}
 			}

 			$usersArray[$i] = [ 
 				'user' => $user, 
 				'ammountAdded' => $ammountAdded, 
 				'currentAmmount' => $currentAmmount, 
 				'investedTimes' => $investedTimes 
 				];
 			$i++;
 		}

 		return View::make('backend.admin.userslist', ['users' => $usersArray]); 		
 	}

 	public function usersListNew() 
 	{
 		$users = User::select('id', 'email')->where('role', '=', '2')->get();
 		$date = new DateTime;
		$date->modify('-5 days');
		$formatted_date = $date->format('Y-m-d H:i:s');

 		$usersArray = [];
 		$i = 0;

 		foreach ($users as $user) {
	 		$ammountAdded = 0;
	 		$currentAmmount = 0;
	 		$investedTimes = 0;
 			foreach ($user->userTransaction as $transaction) {
	 			if ( $transaction->transaction_direction == 'added' ) {
	 				$ammountAdded += $transaction->ammount;
	 				$currentAmmount += $transaction->ammount;
	 			}
	 			if ( $transaction->transaction_direction == 'invested' ) {
	 				$investedTimes++;
	 				$currentAmmount -= $transaction->ammount;
	 			}
	 			var_dump($ammountAdded);
 			}

 			$usersArray[$i] = [ 
 				'user' => $user, 
 				'ammountAdded' => $ammountAdded, 
 				'currentAmmount' => $currentAmmount, 
 				'investedTimes' => $investedTimes 
 				];
 			$i++;
 		}
 		
 		$users = DB::table('users')->select('id', 'email')->where('created_at','>=',$formatted_date)->get();
 		return View::make('backend.admin.userslist', ['users' => $usersArray]);
 	}

 	public function usersListInvestors() 
 	{
 		$users = User::select('id', 'email')->where('investor', '=', '1')->get();
 		$usersArray = [];
 		$i = 0;

 		foreach ($users as $user) {
	 		$ammountAdded = 0;
	 		$currentAmmount = 0;
	 		$investedTimes = 0;
 			foreach ($user->userTransaction as $transaction) {
	 			if ( $transaction->transaction_direction == 'added' ) {
	 				$ammountAdded += $transaction->ammount;
	 				$currentAmmount += $transaction->ammount;
	 			}
	 			if ( $transaction->transaction_direction == 'invested' ) {
	 				$investedTimes++;
	 				$currentAmmount -= $transaction->ammount;
	 			}
	 			var_dump($ammountAdded);
 			}

 			$usersArray[$i] = [ 
 				'user' => $user, 
 				'ammountAdded' => $ammountAdded, 
 				'currentAmmount' => $currentAmmount, 
 				'investedTimes' => $investedTimes 
 				];
 			$i++;
 		}
 		
 		return View::make('backend.admin.userslist', ['users' => $usersArray]);
 	}

 	public function usersListAwarded() 
 	{
 		$users = User::select('id', 'email')->where('awarded', '=', '1')->get();
 		$usersArray = [];
 		$i = 0;

 		foreach ($users as $user) {
	 		$ammountAdded = 0;
	 		$currentAmmount = 0;
	 		$investedTimes = 0;
	 		$investedAmmount = 0;
	 		$awardedAmmount = 0;
 			foreach ( $user->userTransaction as $transaction ) {
	 			if ( $transaction->transaction_direction == 'added' ) {
	 				$ammountAdded += $transaction->ammount;
	 				$currentAmmount += $transaction->ammount;
	 			}
	 			if ( $transaction->transaction_direction == 'invested' ) {
	 				$investedTimes++;
	 				$currentAmmount -= $transaction->ammount;
	 				$investedAmmount += $transaction->ammount;
	 			}
	 			if ( $transaction->transaction_direction == 'awarded' ) {
	 				$awardedAmmount += $transaction->ammount;
	 			}
	 			var_dump($ammountAdded);
 			}

 			$usersArray[$i] = [ 
 				'user' => $user, 
 				'ammountAdded' => $ammountAdded, 
 				'currentAmmount' => $currentAmmount, 
 				'investedTimes' => $investedTimes,
 				'investedAmmount' => $investedAmmount,
 				'awardedAmmount' => $awardedAmmount
 				];
 			$i++;
 		}
 		
 		return View::make('backend.admin.userslist', ['users' => $usersArray]);
 	}

 	public function usersListMonitored() 
 	{
 		$users = User::select('id', 'email')->where('monitored', '=', '1')->get();
 		$usersArray = [];
 		$i = 0;

 		foreach ($users as $user) {
	 		$ammountAdded = 0;
	 		$currentAmmount = 0;
	 		$investedTimes = 0;
 			foreach ($user->userTransaction as $transaction) {
	 			if ( $transaction->transaction_direction == 'added' ) {
	 				$ammountAdded += $transaction->ammount;
	 				$currentAmmount += $transaction->ammount;
	 			}
	 			if ( $transaction->transaction_direction == 'invested' ) {
	 				$investedTimes++;
	 				$currentAmmount -= $transaction->ammount;
	 			}
	 			var_dump($ammountAdded);
 			}

 			$usersArray[$i] = [ 
 				'user' => $user, 
 				'ammountAdded' => $ammountAdded, 
 				'currentAmmount' => $currentAmmount, 
 				'investedTimes' => $investedTimes 
 				];
 			$i++;
 		}
 		
 		return View::make('backend.admin.userslist', ['users' => $usersArray]);
 	}

 	public function usersListAwaiting() 
 	{
 		$users = User::select('id', 'email')->where('investor', '=', '0')->where('role', '=', '2')->get();
 		$usersArray = [];
 		$i = 0;

 		foreach ($users as $user) {
	 		$ammountAdded = 0;
	 		$currentAmmount = 0;
	 		$investedTimes = 0;
 			foreach ($user->userTransaction as $transaction) {
	 			if ( $transaction->transaction_direction == 'added' ) {
	 				$ammountAdded += $transaction->ammount;
	 				$currentAmmount += $transaction->ammount;
	 			}
	 			if ( $transaction->transaction_direction == 'invested' ) {
	 				$investedTimes++;
	 				$currentAmmount -= $transaction->ammount;
	 			}
	 			var_dump($ammountAdded);
 			}

 			$usersArray[$i] = [ 
 				'user' => $user, 
 				'ammountAdded' => $ammountAdded, 
 				'currentAmmount' => $currentAmmount, 
 				'investedTimes' => $investedTimes 
 				];
 			$i++;
 		}
 		
 		return View::make('backend.admin.userslist', ['users' => $usersArray]);
 	}

 	public function usersListNext() 
 	{
 		$users = User::where('investor', '=', 1)->where('role', '=', 2)->get();
 		$i = 0;
 		$usersArray = null;

 		foreach ($users as $user) {
	 		$ammountAdded = 0;
	 		$currentAmmount = 0;
	 		$investedTimes = 0;
	 		$investedAmmount = 0;
	 		$awardedAmmount = 0;
	 		$lastTransaction = Transaction::where('user_id', '=', $user->id)->where('transaction_direction', '=', 'invested')->where('ammount', '>=', '1000')->get();
	 		$lastOffer = count($user->userOffer);
	 		if ( $lastOffer == 0 )
	 			$lastOffer = null;
	 		else
	 			$lastOffer = $user->userOffer[$lastOffer-1]->offer_ends;
	 		$currentDate = date(('Y-m-d H:i:s'));

	 		if ( $lastTransaction->count() != 0
	 			 && ( $lastOffer == null || $currentDate >= $lastOffer ) ) {
	 			foreach ( $user->userTransaction as $transaction ) {
		 			if ( $transaction->transaction_direction == 'added' ) {
		 				$ammountAdded += $transaction->ammount;
		 				$currentAmmount += $transaction->ammount;
		 			}
		 			if ( $transaction->transaction_direction == 'invested' ) {
		 				$investedTimes++;
		 				$currentAmmount -= $transaction->ammount;
		 				$investedAmmount += $transaction->ammount;
		 			}
		 			if ( $transaction->transaction_direction == 'awarded' ) {
		 				$awardedAmmount += $transaction->ammount;
		 			}
	 			}

	 			$usersArray[$i] = [ 
	 				'user' => $user, 
	 				'ammountAdded' => $ammountAdded, 
	 				'currentAmmount' => $currentAmmount, 
	 				'investedTimes' => $investedTimes,
	 				'investedAmmount' => $investedAmmount,
	 				'awardedAmmount' => $awardedAmmount
	 				];
	 			$i++;
 			}
 		}
 		return View::make('backend.admin.userslist', ['users' => $usersArray]);

 	}

}