@extends('emails.base')

@section('title')
<h2>Credentials to add money</h2>
@stop

@section('content')
<div>
	Hello {{ $username }}!
	{{ $text }}
</div>
@stop