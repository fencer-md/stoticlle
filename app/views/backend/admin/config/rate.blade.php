@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Change default reward rate</h3>
    <div class="row">        
        {{ Form::open(['action' => 'ConfigController@update', 'class' => 'form', 'role' => 'form']) }}            
            <div class="form-body">
                <div class="form-group">
                    {{ Form::label('rate', 'Rate') }}
                    <div class="input-group">
                        {{ Form::text('rate', Config::get('rate.rate'), ['class' => 'form-control']) }}
                    </div>
                </div>
        {{ Form::close() }}
	</div>
@stop