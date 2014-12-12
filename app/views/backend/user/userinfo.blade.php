@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Edit profile</h3>
    <div class="row">
            {{ Form::open(['action' => 'UserController@updateInfo', 'files' => true, 'class' => 'form-horizontal']) }}
                <div class="form-body col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('first_name', 'First name', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('first_name', $user_info->first_name, ['class' => 'form-control', $disabled]) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('last_name', 'Surname', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('last_name', $user_info->last_name, ['class' => 'form-control', $disabled]) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('gender', 'Gender', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                <div class="radio-list">
                                    @if ( $user_info->gender == 'male' )
                                        <label class="radio-inline"><div><span>{{ Form::radio('gender', 'male', true, [$disabled]) }}</span></div>M</label>
                                    @else
                                        <label class="radio-inline"><div><span>{{ Form::radio('gender', 'male', null, [$disabled]) }}</span></div>M</label>
                                    @endif

                                    @if ( $user_info->gender == 'female' )
                                        <label class="radio-inline"><div><span>{{ Form::radio('gender', 'female', true, [$disabled]) }}</span></div>F</label>
                                    @else
                                        <label class="radio-inline"><div><span>{{ Form::radio('gender', 'female', null, [$disabled]) }}</span></div>F</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('photo', 'Photo', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                <img src="{{ URL::asset($user_info->photo) }}">
                                {{ Form::file('photo', ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('birth_date', 'Birth date', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('birth_date', $user_info->birth_date, ['placeholder' => 'ex. 1990-01-01 ', 'class' => 'form-control date-picker', 'data-date-format' => 'yyyy-mm-dd', $disabled]) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('country', 'Country', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::select('country', Helper::counties(), $user_info->country, [$disabled]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('city', 'City', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('city', $user_info->city, ['class' => 'form-control', $disabled]) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('password', 'Password', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('password', ['class' => 'form-control', $disabled]) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('re-password', 'Retype password', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('re-password', ['class' => 'form-control', $disabled]) }}
                            </div>
                        </div>                        
                        @if ( Auth::user()->role == 2 )
                            {{ Form::hidden('lat', $user_info->lat) }}
                            {{ Form::hidden('long', $user_info->long) }}
                        @endif
                        <div class="form-actions">
                            @if ( !Request::is('user/admin/edituser/*') )
                                {{ Form::submit('Save', ['class' => 'btn blue']) }}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('facebook', 'Facebook link', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('links[0]', $links[0], ['class' => 'form-control', $disabled]) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('twitter', 'Twitter link', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('links[1]', $links[1], ['class' => 'form-control', $disabled]) }}
                            </div>
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('pinterest', 'Pinterest link', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('links[2]', $links[2], ['class' => 'form-control', $disabled]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('odnoklassniki', 'Odnoklassniki', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('links[3]', $links[3], ['class' => 'form-control', $disabled]) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('vkontacte', 'vKontacte', ['class' => 'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('links[4]', $links[4], ['class' => 'form-control', $disabled]) }}
                            </div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
                @if ( Request::is('user/admin/edituser/*') )
                    {{ Form::open(['action' => 'UserController@updateCommentary', 'class' => 'form-horizontal']) }}
                        <div class="form-body col-md-12">
                            <h4>Commentary</h4>
                            <div class="form-group">
                                <div class="commentary">
                                    <div class="col-md-9">
                                        {{ Form::hidden('uid', $user->id) }}
                                        {{ Form::textarea('user_commentary', $user->commentary) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('showRegion', 'Show on region', ['class' => 'col-md-1 control-label']) }}
                                <div class="col-md-9">
                                    {{ Form::checkbox('showRegion', '1', $user->show_continent == 1 ? true : false, ['class' => 'show-continent', 'uid' => $user->id]) }}
                                </div>
                            </div>
                            <div class="form-group"> 
                                {{ Form::label('showDot', 'Show on Dot', ['class' => 'col-md-1 control-label']) }}
                                <div class="col-md-9">
                                    {{ Form::checkbox('showDot', '1', $user->show_dot == 1 ? true : false, ['class' => 'show-dot', 'uid' => $user->id]) }}
                                </div>
                            </div>
                        </div>
                        {{ Form::submit('Save', ['class' => 'btn blue']) }}
                    {{ Form::close() }}
                @endif
        </div>
    </div>
@stop

@section('custom_scripts')
<script>
    $('#country').selectize({
        create: false,
        persist: false,
        dropdownParent: 'body',
        allowEmptyOption: true
    });
</script>
@if ( Auth::user()->role == 2 )
<script type="text/javascript">
$(document).ready(function(){
    // Get Country and City by IP.
    if ($('#country').val() == '') {
        $.ajax({
            url: 'http://freegeoip.net/json/?callback=?',
            success: function(data){
                $('#city').val(data.city);
                $('#country')[0].selectize.setValue(data.country_code);
                $('#lat').val(data.latitude);
                $('#long').val(data.longitude);
            },
            dataType: 'json',
            crossDomain: true
        });
    }
});
</script>
@endif

@stop