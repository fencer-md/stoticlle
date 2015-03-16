<?php

use Carbon\Carbon;

class SessionsController extends \BaseController {

    public function create()
    {
        return View::make('/');
    }

    public function store()
    {
        $errors = false;

        /* @var $user \User */
        $user = User::where('email', '=', Input::get('email'))->first();

        // Check previous session for users.
        if ($user->role == User::ROLE_USER) {
            if (!empty($user->session) && Session::getId() != $user->session && !$user->session_expires->isPast()) {
                $errors = true;
            }
        }

        if (!$errors) {
            $credentials = Input::only('email','password');
            $credentials['registration_status'] = 1;
            if (Auth::attempt($credentials)) {
                if( Auth::user()->role == "1" ) {
                    return Redirect::to('/user/admin/transactions/all');
                } else {
                    // Set user's session. Will expire in 5 min.
                    $user->session = Session::getId();
                    $sessionExpires = new Carbon();
                    $sessionExpires->addMinutes(5);
                    $user->session_expires = $sessionExpires;
                    $user->save();

                    // Redirect to user's profile when logged in first time.
                    if (!empty(Auth::user()->first_login)) {
                        return Redirect::to('/user/edit');
                    } else {
                        // Redirect to user's transactions.
                        return Redirect::to('/user/transactions');
                    }
                }
            }
        }

        Auth::logout();

        // TODO: Localize error message.
        return Redirect::to('/')
            ->with('errorTitle', 'Login failed.') // Popup title.
            ->with('error', 'Incorrect credentials. <a href="' . action('RemindersController@getRemind') . '">Forgot your password?</a>'); // Message in popup.
    }

    public function destroy()
    {
        $user = Auth::user();

        // Clean user's session.
        if ($user) {
            $user->session = null;
            $user->session_expires = null;
            $user->save();
        }
        Auth::logout();

        return Redirect::to('/');
    }
}
