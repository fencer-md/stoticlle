@extends('emails.base')

@section('title')
<h2>Credentials to add money</h2>
@stop

@section('content')
<div>
	{{ $text }}<br>
	@if ( $credentials != 'none' )
		Credentials: {{ $credentials }}
	@endif
</div>
@stop