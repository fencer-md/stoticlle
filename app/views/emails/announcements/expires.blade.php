@extends('emails.base')

@section('content')
    @include('emails.announcements.expires-text-' . $lang, array(
    'number' => $days,
    'days'=>trans_choice('emails.subscription.days', $days),
    'url'=> $url
    ))
@stop
