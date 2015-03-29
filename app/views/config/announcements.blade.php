@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">{{trans('config.announcements.pageTitle')}}</h3>
    <div class="row">
        {{ Form::open(['class' => 'form', 'role' => 'form']) }}
        <div class="form-body">

            <div class="form-group">
                {{ Form::label('duration', trans('config.announcements.duration')) }}
                <div class="input-group">
                    {{ Form::text('duration', $config['duration'], ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('expiryReminder1', trans('config.announcements.expiryReminder1')) }}
                <div class="input-group">
                    {{ Form::text('expiryReminder1', $config['expiryReminder1'], ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('expiryReminder2', trans('config.announcements.expiryReminder2')) }}
                <div class="input-group">
                    {{ Form::text('expiryReminder2', $config['expiryReminder2'], ['class' => 'form-control']) }}
                </div>
            </div>

            {{ Form::submit(trans('common.save'), ['class' => 'btn blue']) }}
        </div>

        {{ Form::close() }}
    </div>
@stop
