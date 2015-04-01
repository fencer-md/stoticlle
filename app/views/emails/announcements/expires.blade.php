@extends('emails.base')

@section('title')
    <h2>{{trans('emails.subscription.expires', array(
    'days' => trans_choice('emails.subscription.days', $days),
    'number' => $days
    ))}}</h2>
@stop

@section('content')
    Тут будет полезный текст
@stop
