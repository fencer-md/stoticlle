<?php

class OfferController extends \BaseController {

    public function create()
    {
        $uid = Auth::user()->id;
        $offer = new Offer;
        $offer->body = Input::get('body');
        $offer->recipient_id = Input::get('uid');
        $offer->rate = Input::get('rate');
        $offer->offer_ends = Input::get('end_date');
        $offer->save();            

        $recipient = DB::table('users')->where('id', '=', Input::get('uid'))->first();
        $email = $recipient->email;
        $username = $recipient->email;

        $data = ['username' => $username, 'body' => Input::get('body')];

        Mail::send('emails.adminmessage', $data, function($message) {
        	$recipient = DB::table('users')->where('id', '=', Input::get('uid'))->first();
            $message->to($recipient->email, 'test')->subject('Offer');
        });

        return Redirect::to('/user/admin/nextstepusers');
    }

}