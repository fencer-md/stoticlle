@extends('emails.base')

@section('title')
<h2>Transaction confirmation</h2>
@stop

@section('content')
<div>
	Hello {{ $username }}!
	You've successfully added {{ $ammount }}$ to your account!
</div>
@stop