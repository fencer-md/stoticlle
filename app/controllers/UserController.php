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
			$msg = 'Пользователь с этим емайлом уже существует на нашей платформе.';
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
			$userInfo->lat = 0;
			$userInfo->long = 0;
			$userInfo->save();
			$userMoney->save();
			$user->user_info_id = $userInfo->id;
			$user->user_money_id = $userMoney->id;
			$user->email = Input::get('email');
			$user->role = 2;
			$user->awaiting_award = 0;
			$user->investor = 0;
			$user->registration_code = str_random(64);
			$password = str_random(12);
			$user->password = Hash::make($password);
			$user->registration_status = 0;
			$user->save();

			$data = ['code' => $user->registration_code, 'password' => $password];
			Mail::send('emails.confirmation', $data, function($message) {
				$message->to(Input::get('email'), 'test')->subject('Спасибо за регистрацию на нашей платформе!');
			});

			$msg = 'Вам был послан емайл, он содержит линк и пароль для подтверждения вашего емайла, ';

			return Redirect::to('/')->with('msg', $msg);
		}
 	}

	public function confirm($cc)
	{
		$msg = 'Ваш емайл был подтвержден, теперь вы можете войти в систему используя пароль который мы высылали на ваш емайл';
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
        if (empty($links)) {
            $links = array();
        }
        $links = array_pad($links, 5, null);

        return View::make('backend.user.userinfo',
            [
                'user' => $user,
                'user_info' => $user_info,
                'birth_date' => $birth_date,
                'links' => $links,
                'disabled' => $disabled
            ]
        );
	}

	public function updateCommentary()
	{
        /* @var $user User */
		$uid = Input::get('uid');
		$user = User::find($uid);
		$user->commentary = Input::get('user_commentary');
		$user->monitored = Input::get('monitored');

		if (Input::get('password') == Input::get('re-password') && Input::get('re-password') != '') {
			$user->password = Hash::make(Input::get('re-password'));
		}
        // Update announcement info.
        $oldAnnouncement = $user->announcement_stream;
        $user->announcement_stream = Input::get('announcement_stream');
        // New announcements will start next day.
        if ($oldAnnouncement != $user->announcement_stream) {
            $start = new Carbon\Carbon();
            $start->setTime(0, 0, 0)->addDay();
            $user->announcement_start = $start;
            $user->announcement_expires = $start->addDays(Config::get('announcements.duration'));
        }

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
        if (empty($links)) {
            $links = array();
        }
        $links = array_pad($links, 5, null);

        $streams = AnnouncementSeries::all();
        $announcementsStreams = array(0 => 'Отключены');
        foreach ($streams as $s) {
            $announcementsStreams[$s->id] = $s->name;
        }

		return View::make(
            'backend.user.userinfo',
            [
                'user' => $user,
                'user_info' => $user_info,
                'birth_date' => $birth_date,
                'links' => $links,
                'disabled' => $disabled,
                'announcements_streams' => $announcementsStreams,
            ]
        );
	}

 	public function updateInfo()
 	{
 		$linksArray = Input::get('links');
        // check if we have all social links (fill array with empty data).
        $linksArray = array_pad($linksArray, 5, null);
        $linksArray = json_encode($linksArray);

		$id = Auth::user()->id;
		$user = User::find($id);
		$user_info = UserInfo::find($user->user_info_id);

        // Change password if needed.
        // TODO: Add some error messages.
        if (Input::get('password') == Input::get('re-password') && Input::get('re-password') != '') {
            $user->password = Hash::make(Input::get('re-password'));
        }

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
			Image::make(Input::file('photo'))->heighten(200)->save( public_path('uploads/user-photos/').$filename );
	        $user_info->photo = $path;
	    }
	    if ( Input::get('lat') && Input::get('long') ) {
			$user_info->lat = round(Input::get('lat'), 2);
			$user_info->long = round(Input::get('long'), 2);
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

		if ($sortby && $order) {
			$users = User::where('role', '=', '2')
				->orderBy($sortby, $order)
				->get();
		} else {
			$users = User::where('role', '=', '2')->get();
		}

		return View::make(
			'backend.admin.userslist',
			['users' => $users, 'controller' => $controller, 'sortby' => $sortby, 'order' => $order]
		);
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
		if (Input::has('showRegion')) {
			$user->show_continent = (int)Input::get('showRegion');
		}
		if (Input::has('showDot')) {
			$user->show_dot = (int)Input::get('showDot');
		}

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
