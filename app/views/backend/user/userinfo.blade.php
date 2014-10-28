@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Edit profile</h3>
    <div class="row">
            {{ Form::open(['action' => 'UserController@updateInfo', 'class' => 'form-horizontal']) }}
                <div class="form-body col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('first_name', 'First name', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('first_name', $user_info->first_name, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('last_name', 'Surname', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('last_name', $user_info->last_name, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('gender', 'Gender', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                <div class="radio-list">
                                    @if ( $user_info->gender == 'male' )
                                        <label class="radio-inline"><div><span>{{ Form::radio('gender', 'male', true) }}</span></div>M</label>
                                    @else
                                        <label class="radio-inline"><div><span>{{ Form::radio('gender', 'male') }}</span></div>M</label>
                                    @endif

                                    @if ( $user_info->gender == 'female' )
                                        <label class="radio-inline"><div><span>{{ Form::radio('gender', 'female', true) }}</span></div>F</label>
                                    @else
                                        <label class="radio-inline"><div><span>{{ Form::radio('gender', 'female') }}</span></div>F</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('birth_date', 'Birth date', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('birth_date', $user_info->birth_date, ['placeholder' => 'ex. 1990-01-01 ', 'class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('country', 'Country', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('country', $user_info->country, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('city', 'City', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('city', $user_info->city, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('password', 'Password', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('password', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('re-password', 'Retype password', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('re-password', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-actions"> 
                            {{ Form::submit('Save', ['class' => 'btn blue']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{ Form::hidden('links', 2) }}
                        <div class="form-group"> 
                            {{ Form::label('facebook', 'Facebook link', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('link-1', $links[0], ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('twitter', 'Twitter link', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('link-2', $links[1], ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('pinterest', 'Pinterest link', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('link-2', $links[1], ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
                @if ( Request::is('user/admin/edituser/*') )
                    <div class="col-md-12">
                        <h4>Commentary</h4>
                        <div class="commentary">
                            {{ Form::open(['action' => 'UserController@updateCommentary', 'class' => 'form-horizontal']) }}
                                {{ Form::hidden('uid', $user->id) }}
                                {{ Form::textarea('user_commentary', $user->commentary) }}
                                {{ Form::submit('Save', ['class' => 'btn default btn-xs blue']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                @endif
        </div>
    </div>
@stop