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
            if( Auth::user()->role == "1" ) {
                return Redirect::to('/user/admin/transactions/all');
            } else {
                // Redirect to user's profile when logged in first time.
                if (!empty(Auth::user()->first_login)) {
                    return Redirect::to('/user/edit');
                } else {
                    // Redirect to user's transactions.
                    return Redirect::to('/user/transactions');
                }
            }
        } else {
            Auth::logout();

            // TODO: Localize error message.
            return Redirect::to('/')
                ->with('errorTitle', 'Login failed.') // Popup title.
                ->with('error', 'Incorrect credentials. <a href="' . action('RemindersController@getRemind') . '">Forgot your password?</a>'); // Message in popup.
        }
    }

    public function destroy()
    {
        Auth::logout();

        return Redirect::to('/');
    }

}