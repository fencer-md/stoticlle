@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Cash out money</h3>
    <div class="row">
        {{ Form::open(['action' => 'TransactionsController@cashOutRequest', 'class' => 'form-horizontal']) }}
            <div class="form-body col-md-3">
                <div class="form-group">
                    {{ Form::label('cash_out_ammount', 'Ammount to take', ['class' => 'control-label']) }}
                    <div class="controls">
                        <div class="col-md-9">
                          {{ Form::text('cash_out_ammount', null, ['class' => 'form-control']) }}
                        </div>
                      {{ Form::submit('Submit', ['class' => 'btn blue']) }}
                    </div>
                </div>
            </div>  
        {{ Form::close() }}
    </div>
@stop