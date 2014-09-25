@extends('user.base')

@section('content')
<div class="wrapper">
	@if ( Auth::user() == null )
		<a href="{{ URL::to('login') }}">Login</a>
		<a href="{{ URL::to('register') }}">Register</a>
	@else
		<div class="menu">
			<a href="{{ URL::to('user/edit') }}">Edit profile</a>
			<a href="{{ URL::to('user/transactions') }}">User transactions</a>
			<a href="{{ URL::to('user/admin/transactions') }}">Admin transactions</a>
			<a href="{{ URL::to('logout') }}">Logout</a>
		</div>
		<div class="content">
			{{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => '']) }}
				{{ Form::label('invest_amount', 'Invest') }}
			    {{ Form::text('invest_amount') }}
			    {{ Form::submit('Submit') }}	
			{{ Form::close() }}
		</div>
	@endif
</div>
@stop