@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Edit profile</h3>
    <div class="row-fluid">
        {{ Form::open(['action' => 'UserController@updateInfo', 'class' => 'form-horizontal']) }}
            <div class="form-body col-md-3">
                <div class="control-group">
                    {{ Form::label('first_name', 'First name', ['class' => 'control-label']) }}
                    <div class="controls">
                        {{ Form::text('first_name', $user_info->first_name, ['class' => 'm-wrap large']) }}
                    </div>
                </div>
                <div class="control-group"> 
                    {{ Form::label('last_name', 'Surname', ['class' => 'control-label']) }}
                    <div class="controls">
                        {{ Form::text('last_name', $user_info->last_name, ['class' => 'm-wrap large']) }}
                    </div>
                </div>
                <div class="control-group"> 
                    {{ Form::label('gender', 'Gender', ['class' => 'control-label']) }}
                    <div class="controls">
                        @if ( $user_info->gender == 'male' )
                            <label class="radio"><div><span>{{ Form::radio('gender', 'male', true) }}</span></div>M</label>
                        @else
                            <label class="radio"><div><span>{{ Form::radio('gender', 'male') }}</span></div>M</label>
                        @endif

                        @if ( $user_info->gender == 'female' )
                            <label class="radio"><div><span>{{ Form::radio('gender', 'female', true) }}</span></div>F</label>
                        @else
                            <label class="radio"><div><span>{{ Form::radio('gender', 'female') }}</span></div>F</label>
                        @endif
                    </div>
                </div>
                <div class="control-group"> 
                    {{ Form::label('birth_date', 'Birth date', ['class' => 'control-label']) }}
                    <div class="controls">
                        {{ Form::text('birth_date', $user_info->birth_date, ['placeholder' => 'ex. 1990-01-01 ', 'class' => 'm-wrap large']) }}
                    </div>
                </div>
                <div class="control-group"> 
                    {{ Form::label('country', 'Country', ['class' => 'control-label']) }}
                    <div class="controls">
                        {{ Form::text('country', $user_info->country, ['class' => 'm-wrap large']) }}
                    </div>
                </div>
                <div class="control-group"> 
                    {{ Form::label('city', 'City', ['class' => 'control-label']) }}
                    <div class="controls">
                        {{ Form::text('city', $user_info->city, ['class' => 'm-wrap large']) }}
                    </div>
                </div>
                <div class="form-actions"> 
                    {{ Form::submit('Save', ['class' => 'btn blue']) }}
                </div>
            </div>
        {{ Form::close() }}
    </div>
@stop