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
			$user->registration_status = '0';
			$user->save();

			/*
			$data = ['code' => $user->registration_code];
			Mail::send('emails.confirmation', $data, function($message) {
				$message->to(Input::get('email'), 'test')->subject('Welcome!');
			});
			*/

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
		if ( Auth::user()->type == '2' )
		{
			$id = Auth::user()->id;
			$user = User::find($id);
			$user_info = UserInfo::find($user->user_info_id);
			$address = Address::find($user_info->address_id);
			if ( $user_info->birth_date == null )
				$birth_date = null;
			else
				$birth_date = explode("-", $user_info->birth_date);

			return View::make('userpanel.buyerprofile', ['user' => $user, 'user_info' => $user_info, 'birth_date' => $birth_date, 'address' => $address]);
		}
	}

 	public function updateInfo()
 	{
		if ( Auth::user()->type == '2' )
		{
			$id = Auth::user()->id;
			$user = User::find($id);
			$user_info = UserInfo::find($user->user_info_id);
			$address = Address::find($user_info->address_id);
			$user->email = Input::get('email');
			$user_info->first_name = Input::get('first_name');
			$user_info->last_name = Input::get('last_name');
			$user_info->gender = Input::get('gender');
			$birth_date = Input::get('year') . '-' . Input::get('month') . '-' . Input::get('day');
			$user_info->birth_date = $birth_date;
			$user_info->gender = Input::get('gender');
			$address->address = Input::get('address');
			$address->city = Input::get('city');
			$address->zip = Input::get('zip');
			$address->country = Input::get('country');
			$address->phone_number = Input::get('phone');
			$user->save();
			$user_info->save();
			$address->save();
			return Redirect::back();
 		}
 	}

}