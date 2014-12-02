@extends('user.base')

@section('content')
<div class="wrapper">
	<div class="menu">
		<a href="{{ URL::previous() }}"><< Back</a>
	</div>
	<div class="content">
		{{ Form::open(['route' => 'user.store', 'class' => 'form-signin']) }}
		    {{ Form::text('email', null, ['placeholder' => 'E-mail']) }}
		    {{ Form::submit('Submit') }}
		{{ Form::close() }}
	</div>
</div>
@stop