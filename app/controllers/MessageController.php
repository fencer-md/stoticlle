<?php

class MessageController extends \BaseController {

    public function create()
    {

        $uid = Auth::user()->id;
        $message = new Message;
        $message->title = Input::get('title');
        $message->body = Input::get('body');
        $message->mass_message = 0;
        $message->author_id = $uid;
        if ( Input::get('recipient') != null ) {
            $recipient = DB::table('users')->where('email', '=', Input::get('recipient'))->first();
            $message->recipient_id = $recipient->id;
        } else
        $message->recipient_id = null;
        $message->save();

        if ( Input::get('recipient') != null ) {
            $email = Input::get('recipient');
            $username = $recipient->email;
            $body = Input::get('body');

            $data = ['username' => $username, 'body' => $body];

            Mail::send('emails.adminmessage', $data, function($message) {
                $message->to(Input::get('recipient'), 'test')->subject(Input::get('title'));
            });
        }

        return Redirect::to('/user/messages');
    }

    public function messageList() {
        if ( Auth::user()->role == 1 ) 
        {
            $messages = Message::all();        
            return View::make('backend.user.messagelist')->with('data', $messages);
        } 
        elseif ( Auth::user()->role == 2 )
        {
            $messages = Message::where('recipient_id', '=', Auth::user()->id)->orWhere('mass_message', '=' ,1)->get();        
            return View::make('backend.user.messagelist')->with('data', $messages);
        }

    }

}