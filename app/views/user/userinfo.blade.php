@extends('user.base')

@section('content')
<div class="wrapper">
    <div class="menu">
        <a href="{{ URL::to('user/edit') }}">Edit profile</a>
        <a href="{{ URL::to('user/transactions') }}">User transactions</a>
        <a href="{{ URL::to('user/admin/transactions') }}">Admin transactions</a>
        <a href="{{ URL::to('logout') }}">Logout</a>
    </div>
    <div class="content">
        {{ Form::open(['action' => 'UserController@updateInfo', 'class' => '']) }}
        	{{ Form::label('first_name', 'First name') }}
            {{ Form::text('first_name', $user_info->first_name) }}
            <p>
        	{{ Form::label('last_name', 'Surname') }}
            {{ Form::text('last_name', $user_info->last_name) }}
            <p>
        	{{ Form::label('gender', 'Gender') }}
            {{ Form::label('gender', 'M') }}
            @if ( $user_info->gender == 'male' )
                {{ Form::radio('gender', 'male', true) }}
            @else
                {{ Form::radio('gender', 'male') }}        
            @endif
            {{ Form::label('gender', 'F') }}
            @if ( $user_info->gender == 'female' )
                {{ Form::radio('gender', 'female', true) }}
            @else
                {{ Form::radio('gender', 'female') }}        
            @endif
            <p>
        	{{ Form::label('birth_date', 'Birth date') }}
            {{ Form::text('birth_date', $user_info->birth_date, ['placeholder' => 'ex. 1990-01-01 ']) }}
            <p>
        	{{ Form::label('country', 'Country') }}
            {{ Form::text('country', $user_info->country, ['placeholder' => '']) }}
            <p>
        	{{ Form::label('city', 'City') }}
            {{ Form::text('city', $user_info->city, ['placeholder' => '']) }}
            <p>
            {{ Form::submit('Save') }}
        {{ Form::close() }}
    </div>
</div>
@stop