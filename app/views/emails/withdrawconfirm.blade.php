@extends('emails.base')

@section('title')
<h2>Transaction confirmation</h2>
@stop

@section('content')
<div>
	You've successfully withdrawn {{ $ammount }}$ !
</div>
@stop