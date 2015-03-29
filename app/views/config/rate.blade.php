@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">{{trans('config.rate.pageTitle')}}</h3>
    <div class="row">
        {{ Form::open(['class' => 'form', 'role' => 'form']) }}
        <div class="form-body">
            <div class="form-group">
                {{ Form::label('rate', trans('config.rate.rate')) }}
                <div class="input-group">
                    {{ Form::text('rate', $config['original_rate'], ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('days', trans('config.rate.cycle')) }}
                <div class="input-group">
                    {{ Form::text('days', $config['days'], ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('min', trans('config.rate.minimal')) }}
                <div class="input-group">
                    {{ Form::text('min', $config['min'], ['class' => 'form-control']) }}
                </div>
            </div>
            {{ Form::submit(trans('common.save'), ['class' => 'btn blue']) }}
        </div>
        {{ Form::close() }}
    </div>
@stop
