<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request) {
    // Detect site language from browser and cookies.
    /* @var $request \Illuminate\Http\Request */
    if (Cookie::has('lang')) {
        $lang = Cookie::get('lang');
    } else {
        $lang = $request->getLocale();
    }
    App::setLocale($lang);
    Lang::setLocale($lang);

    // Update user's session expiration time.
    if (Auth::user()) {
        /* @var $user User */
        $user = Auth::user();
        $expires = new Carbon\Carbon();
        $expires->addMinutes(5);
        $user->session_expires = $expires;
        $user->save();
    }
});


App::after(function($request, $response)
{
	//
});

App::missing(function($exception)
{
    return Response::view('errors.404', array('url' => Request::url()), 404);
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function ()
{
	if (Auth::guest()) {
		if (Request::ajax()) {
			return Response::make('Unauthorized', 401);
		} else {
			return Redirect::guest('/')
				->with('errorTitle', 'Session expired.')
				->with('error', 'Please login.');
		}
	}
});

Route::filter('admin', function()
{
	if (Auth::user()->role == '2')
		return print("You don't have enough rights to access this page");
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
   $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
   if (Session::token() != $token) {
      throw new Illuminate\Session\TokenMismatchException;
   }
});

// Load file with View::create directives.
require app_path().'/view_creators.php';
require app_path().'/blade.php';
