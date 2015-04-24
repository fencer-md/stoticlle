@extends('emails.base')

@section('title')
<h2>Add money request</h2>
@stop

@section('content')
<div>
	Hello {{ $username }}!
	You've succesufully added {{ $ammount }} to Jarvis.
	{{ $text }}
</div>
@stop