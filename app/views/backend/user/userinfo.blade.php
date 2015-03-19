@extends('layouts.backend.base')

@section('content')
	<div class="center-big-width clearfix">
    <h3 class="page-title">Редактирование ваших личных Данных</h3>
    <div class="row">
        @if ( Request::is('user/admin/edituser/*') )
            {{ Form::open(['action' => 'UserController@updateCommentary', 'class' => 'form-horizontal']) }}
        @else
            {{ Form::open(['action' => 'UserController@updateInfo', 'files' => true, 'class' => 'form-horizontal']) }}
        @endif

        <div class="form-body col-md-12 user-edit-info">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('first_name', 'Имя', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('first_name', $user_info->first_name, ['class' => 'form-control', $disabled]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('last_name', 'Фамилия', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('last_name', $user_info->last_name, ['class' => 'form-control', $disabled]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('gender', 'Пол', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        <div class="radio-list">
                            @if ( $user_info->gender == 'male' )
                                <label class="radio-inline">
                                    <div><span>{{ Form::radio('gender', 'male', true, [$disabled]) }}</span></div>
                                    &nbsp;М</label>
                            @else
                                <label class="radio-inline">
                                    <div><span>{{ Form::radio('gender', 'male', null, [$disabled]) }}</span></div>
                                     &nbsp;М</label>
                            @endif

                            @if ( $user_info->gender == 'female' )
                                <label class="radio-inline">
                                    <div><span>{{ Form::radio('gender', 'female', true, [$disabled]) }}</span></div>
                                    &nbsp;Ж</label>
                            @else
                                <label class="radio-inline">
                                    <div><span>{{ Form::radio('gender', 'female', null, [$disabled]) }}</span></div>
                                    &nbsp;Ж</label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('birth_date', 'Дата рождения', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('birth_date', $user_info->birth_date, ['placeholder' => 'ex. 1990-01-01 ', 'class' => 'form-control date-picker', 'data-date-format' => 'yyyy-mm-dd', $disabled]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('country', 'Страна', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::select('country', Helper::counties(), $user_info->country, [$disabled]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('city', 'Город', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('city', $user_info->city, ['class' => 'form-control', $disabled]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Пароль', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::password('password', ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('re-password', 'Повторить пароль', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::password('re-password', ['class' => 'form-control']) }}
                    </div>
                </div>

            </div>
            <div class="col-md-6">
            		<div class="form-group">
                    {{ Form::label('photo', 'Фотография', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                    		{{ Form::file('photo', ['class' => 'form-control']) }}
                        <img src="{{ URL::asset($user_info->photo) }}">       
                    </div>
                </div>
                <div class="page-title"><span>Социальные сети</span><div class="line"></div></div>
                <div class="form-group">
                    {{ Form::label('facebook', 'Фэйсбук', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('links[0]', $links[0], ['class' => 'form-control', $disabled]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('twitter', 'Твитер', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('links[1]', $links[1], ['class' => 'form-control', $disabled]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('pinterest', 'Пинтерест', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('links[2]', $links[2], ['class' => 'form-control', $disabled]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('odnoklassniki', 'Однокласники', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('links[3]', $links[3], ['class' => 'form-control', $disabled]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('vkontacte', 'вКонтакте', ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        {{ Form::text('links[4]', $links[4], ['class' => 'form-control', $disabled]) }}
                    </div>
                </div>
                @if ($disabled)
                    <div class="form-group">
                        {{ Form::label('announcement_stream', 'Анонсы', ['class' => 'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::select('announcement_stream', $announcements_streams, $user->announcement_stream, ['class' => 'form-control']) }}
                        </div>
                    </div>
                @endif
                @if ( Auth::user()->role == 2 )
                    {{ Form::hidden('lat', $user_info->lat) }}
                    {{ Form::hidden('long', $user_info->long) }}
                @endif
                <div class="form-actions col-md-10">
                    @if ( !Request::is('user/admin/edituser/*') )
                        {{ Form::submit('Сохронить', ['class' => 'btn']) }}
                    @endif
                </div>
            </div>
        </div>

        @if ( Request::is('user/admin/edituser/*') )
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
        @endif

        {{ Form::close() }}
    </div>
	</div>
@stop

@section('custom_scripts')
<script>
    $('#country').selectize();
</script>
@if ( Auth::user()->role == 2 )
<script type="text/javascript">
    $(document).ready(function(){
    $("input#photo").uniform();
        // Get Country and City by IP.
        if ($('#country').val() == '') {
            $.ajax({
                url: 'http://freegeoip.net/json/?callback=?',
                success: function(data){
                    $('#city').val(data.city);
                    $('#country')[0].selectize.setValue(data.country_code);
                    $('input[name=lat]').val(data.latitude);
                    $('input[name=long]').val(data.longitude);
                },
                dataType: 'json',
                crossDomain: true
            });
        }
    });
</script>
@endif

@stop