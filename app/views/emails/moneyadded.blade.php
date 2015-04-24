@extends('emails.base')

@section('title')
<h2>Transaction confirmation</h2>
@stop

@section('content')
<div>
	You've requested to add {{ $ammount }}$ to your account, wait for the response.
</div>
@stop