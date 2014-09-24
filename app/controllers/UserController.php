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
		$msg= 'Thank you for registration, you now can login and begin shopping';
		$user = User::where('registration_code', '=', $cc)->first();
		$user->registration_status = 1;
		$user->registration_code = 0;
		$user->save();
		return Redirect::to('/')->with('msg',$msg);
	}

	public function editUserInfo()
	{
		if ( Auth::user()->role == '2' )
		{
			$id = Auth::user()->id;
			$user = User::find($id);
			$user_info = UserInfo::find($user->user_info_id);
			if ( $user_info->birth_date == null )
				$birth_date = null;
			else
				$birth_date = explode("-", $user_info->birth_date);

			return View::make('user.userinfo', ['user' => $user, 'user_info' => $user_info, 'birth_date' => $birth_date]);
		} else {
			return 'You\'re not logged in';
		}
	}

 	public function updateInfo()
 	{
		if ( Auth::user()->role == '2' )
		{
			$id = Auth::user()->id;
			$user = User::find($id);
			$user_info = UserInfo::find($user->user_info_id);
			$user->email = Input::get('email');
			$user_info->first_name = Input::get('first_name');
			$user_info->last_name = Input::get('last_name');
			$user_info->gender = Input::get('gender');
			$user_info->birth_date = Input::get('birth_date');
			$user_info->country = Input::get('country');
			$user_info->city = Input::get('city');
			$user->save();
			$user_info->save();
			return Redirect::back()->with(['message' => 'updated']);
 		}
 	}

 	public function usersList() 
 	{
 		$users = User::select('id', 'email')->get();
 		
 		return View::make('user.userslist', ['users' => $users]);
 	}

}