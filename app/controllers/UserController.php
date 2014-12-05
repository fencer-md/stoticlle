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
			$msg = 'User with this email exists already.';
			return Redirect::to('/')
		    	->withErrors($validate)
		        ->withInput()
		        ->with('msg', $msg);
		}
		else
		{
			$user = new User;
			$userInfo = new UserInfo;
			$userMoney = new UserMoney;
			$userInfo->save();
			$userMoney->save();
			$user->user_info_id = $userInfo->id;
			$user->user_money_id = $userMoney->id;
			$user->email = Input::get('email');
			$user->role = '2';
			$user->awaiting_award = '0';
			$user->registration_code = str_random(64);
			$password = str_random(12);
			$user->password = Hash::make($password);
			$user->registration_status = '0';
			$user->save();

			$data = ['code' => $user->registration_code, 'password' => $password];
			Mail::send('emails.confirmation', $data, function($message) {
				$message->to(Input::get('email'), 'test')->subject('Welcome!');
			});

			$msg = 'You\'ve been sent an email, to activate your account please click on the link in the email.';

			return Redirect::to('/')->with('msg', $msg);
		}
 	}

	public function confirm($cc)
	{
		$msg = 'Thank you for registration, you now can login';
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

		$disabled = null;
		$links = json_decode($user_info->links);

		if ( $user_info->country != NULL ) {
			$country = Country::where('code', $user_info->country)->first();
			$country = $country->name;
		} else $country = null;

		return View::make('backend.user.userinfo', ['user' => $user, 'user_info' => $user_info, 'birth_date' => $birth_date, 'country' => $country, 'links' => $links, 'disabled' => $disabled]);
	}

	public function updateCommentary()
	{
		$uid = Input::get('uid');
		$user = User::find($uid);
		$user->commentary = Input::get('user_commentary');
		$user->monitored = Input::get('monitored');

 		if ( Input::get('showRegion') == 1 )
 			$user->show_continent = 1;
 		if ( Input::get('showDot') == 1 )
 			$user->show_dot = 1;
 		if ( Input::get('showRegion') == 0 )
 			$user->show_continent = 0;
 		if ( Input::get('showDot') == 0 )
 			$user->show_dot = 0;
 		
		$user->save();

		return Redirect::back();
	}

	public function editUserInfoAdmin($uid)
	{
		$user = User::find($uid);
		$user_info = UserInfo::find($user->user_info_id);
		if ( $user_info->birth_date == null )
			$birth_date = null;
		else
			$birth_date = explode("-", $user_info->birth_date);

		$disabled = 'disabled';
		$links = json_decode($user_info->links);

		return View::make('backend.user.userinfo', ['user' => $user, 'user_info' => $user_info, 'birth_date' => $birth_date, 'links' => $links, 'disabled' => $disabled]);
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
		if ( Input::get('birth_date') )
			$user_info->birth_date = Input::get('birth_date');
		$user_info->country = Input::get('country');
		$user_info->city = Input::get('city');
		$user_info->links = $linksArray;

		if ( Input::file('photo') ) {
			$photo = Input::file('photo');
			$filename = date('Ymdhis')."-".$photo->getClientOriginalName();
			$path = 'uploads/user-photos/'.$filename;
			Image::make(Input::file('photo'))->resize(200, 200)->save( public_path('uploads/user-photos/').$filename );
	        $user_info->photo = $path;
	    }

		$user->save();
		$user_info->save();

		return Redirect::back();

 	}

 	public function usersList() 
 	{
 		$sortby = Input::get('sortby');
 		$order = Input::get('order');
 		$controller = 'usersList';

 		if ( $sortby && $order ) 			
 			$users = User::where('role', '=', '2')
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->orderBy($sortby, $order)
 						   ->get();
 		else
 			$users = User::where('role', '=', '2')
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->get(); 						   

 		return View::make('backend.admin.userslist', ['users' => $users, 'controller' => $controller, 'sortby' => $sortby, 'order' => $order]); 		
 	}

 	public function usersListNew() 
 	{
 		$sortby = Input::get('sortby');
 		$order = Input::get('order');
 		$controller = 'usersListNew';

 		$date = new DateTime;
		$date->modify('-5 days');
		$formatted_date = $date->format('Y-m-d H:i:s');

 		if ( $sortby && $order ) 			
 			$users = User::where('role', '=', '2')
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->orderBy($sortby, $order)
 						   ->get();
 		else
 			$users = User::where('role', '=', '2')
 						   ->where('users.created_at', '>=', $formatted_date)
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->get();

 		return View::make('backend.admin.userslist', ['users' => $users, 'controller' => $controller, 'sortby' => $sortby, 'order' => $order]);
 	}

 	public function usersListInvestors() 
 	{
 		$sortby = Input::get('sortby');
 		$order = Input::get('order');
 		$controller = 'usersListInvestors';

 		if ( $sortby && $order ) 			
 			$users = User::where('role', '=', '2')
 						   ->whereNotNull('users.invested_date')
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->orderBy($sortby, $order)
 						   ->get();
 		else
 			$users = User::where('role', '=', '2')
 						   ->whereNotNull('users.invested_date')
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->get();
 		
 		return View::make('backend.admin.userslist', ['users' => $users, 'controller' => $controller, 'sortby' => $sortby, 'order' => $order]);
 	}

 	public function usersListAwarded() 
 	{
 		$sortby = Input::get('sortby');
 		$order = Input::get('order');
 		$controller = 'usersListAwarded';

 		if ( $sortby && $order ) 			
 			$users = User::where('awarded', '=', '1')
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->orderBy($sortby, $order)
 						   ->get();
 		else
 			$users = User::where('awarded', '=', '1')
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->get();
 		
 		return View::make('backend.admin.userslist', ['users' => $users, 'controller' => $controller, 'sortby' => $sortby, 'order' => $order]);
 	}

 	public function usersListMonitored() 
 	{
 		$sortby = Input::get('sortby');
 		$order = Input::get('order');
 		$controller = 'usersListMonitored';

 		if ( $sortby && $order ) 			
 			$users = User::where('monitored', '=', 'true')
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->orderBy($sortby, $order)
 						   ->get();
 		else
 			$users = User::where('monitored', '=', 'true')
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->get();
 		
 		return View::make('backend.admin.userslist', ['users' => $users, 'controller' => $controller, 'sortby' => $sortby, 'order' => $order]);
 	}

 	public function usersListAwaiting() 
 	{
 		$sortby = Input::get('sortby');
 		$order = Input::get('order');
 		$controller = 'usersListAwaiting';

 		if ( $sortby && $order )
 			$users = User::whereNull('users.invested_date')
 						   ->where('users.role', '=', '2')
 						   ->where('users.investor', '!=', 1)
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->orderBy($sortby, $order)->get();
 		else
 			$users = User::whereNull('users.invested_date')
 						   ->where('users.role', '=', '2')
 						   ->where('users.investor', '!=', 1)
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->get();
 		
 		return View::make('backend.admin.userslist', ['users' => $users, 'controller' => $controller, 'sortby' => $sortby, 'order' => $order]);
 	}

 	public function usersListNext() 
 	{
 		$sortby = Input::get('sortby');
 		$order = Input::get('order');
 		$controller = 'usersListNext';

 		if ( $sortby && $order )
 			$users = User::where('users.investor', '=', 1)
 						   ->where('users.role', '=', 2)
 						   ->where('users.investor', '=', 1)
 						   ->where('users.awaiting_award', '=', 0)
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->orderBy($sortby, $order)
 						   ->get();
 		else
 			$users = User::where('users.investor', '=', 1)
 						   ->where('users.role', '=', 2)
 						   ->where('users.investor', '=', 1)
 						   ->where('users.awaiting_award', '=', 0)
 						   ->join('user_money_info', 'users.id', '=', 'user_money_info.id')
 						   ->get();

 		foreach ($users as $key => $user) {
	 		$lastTransaction = Transaction::where('user_id', '=', $user->id)->where('ammount', '>=', '1000')->where('confirmed', '=', 0)->where('transaction_direction', '=', 'invested')->first();

	 		$lastOffer = count($user->userOffer);
	 		if ( $lastOffer == 0 )
	 			$lastOffer = null;
	 		else
	 			$lastOffer = $user->userOffer[$lastOffer-1]->offer_ends;

	 		$currentDate = date(('Y-m-d H:i:s'));

	 		if ( $lastTransaction == null
	 			 && ( $lastOffer == null || $currentDate < $lastOffer ) ){
	 			unset($users[$key]);
	 		}

	 		if ( $lastOffer != null && $currentDate < $lastOffer ){
	 			unset($users[$key]);
	 		}
 		}

 		return View::make('backend.admin.userslist', ['users' => $users, 'controller' => $controller, 'sortby' => $sortby, 'order' => $order]);
 	}

 	public function showOnMap() 
 	{
 		$user = User::find(Input::get('uid'));

 		if ( Input::get('showRegion') == 1 )
 			$user->show_continent = 1;
 		if ( Input::get('showDot') == 1 )
 			$user->show_dot = 1;
 		if ( Input::get('showRegion') == 0 )
 			$user->show_continent = 0;
 		if ( Input::get('showDot') == 0 )
 			$user->show_dot = 0;

 		$user->save();
 	}

 	public function updateCoords() {
		$uid = Auth::user()->id;
		$user_info = UserInfo::find($uid);
		$user_info->lat = Input::get('lat');
		$user_info->long = Input::get('long');
		$user_info->save();
 	}

}
