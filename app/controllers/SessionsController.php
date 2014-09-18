<?php

class SessionsController extends \BaseController {

    public function create()
    {
        return View::make('/');
    }

    public function store()
    {
        $user = User::where('email', '=', Input::get('email'))->first();
        if ( Auth::attempt(Input::only('email','password')) && $user->registration_status == '1' )
        {
            return Redirect::to('/');
        }
        return 'Failed login attempt';

    }

    public function destroy()
    {
        Auth::logout();

        return Redirect::to('/');
    }

}