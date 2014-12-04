@extends('user.base')

@section('content')
<div class="wrapper">
	<div class="menu">
		<a href="{{ URL::previous() }}"><< Back</a>
	</div>
	<div class="content">
		{{ Form::open(['action' => 'SessionsController@store', 'class' => '']) }}
		    {{ Form::text('email', null, ['placeholder' => 'E-mail']) }}
		    {{ Form::password('password', null, ['placeholder' => 'Password']) }}
		    {{ Form::submit('Login') }}
		{{ Form::close() }}
	</div>
</div>
@stop