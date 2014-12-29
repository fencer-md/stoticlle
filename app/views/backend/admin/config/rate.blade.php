@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Change default reward rate and cycle duration</h3>
    <div class="row">        
        {{ Form::open(['action' => 'ConfigController@update', 'class' => 'form', 'role' => 'form']) }}            
            <div class="form-body">
                <div class="form-group">
                    {{ Form::label('rate', 'Rate') }}
                    <div class="input-group">
                        {{ Form::text('rate', Config::get('rate.original_rate'), ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('days', 'Cycle duration') }}
                    <div class="input-group">
                        {{ Form::text('days', Config::get('rate.days'), ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('min', 'Minimal amount') }}
                    <div class="input-group">
                        {{ Form::text('min', Config::get('rate.min'), ['class' => 'form-control']) }}
                    </div>
                </div>
                {{ Form::submit('Submit', ['class' => 'btn blue']) }}
            </div>
        {{ Form::close() }}
	</div>
@stop