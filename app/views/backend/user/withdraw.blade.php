@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Withdraw money</h3>
    <div class="row">
		{{ Form::open(['action' => 'TransactionsController@withdrawRequest', 'class' => 'form-horizontal']) }}
            {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
            <div class="form-body col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('ammount', 'Ammount to withdraw', ['class' => 'control-label']) }}
                        <div class="controls">
                            <div class="col-md-3">
                              {{ Form::text('ammount', null, ['class' => 'form-control']) }}
                            </div>
                          {{ Form::submit('Submit', ['class' => 'btn blue']) }}
                        </div>
                    </div>
                </div> 
                <div class="col-md-6">
                </div>
            </div>
        {{ Form::close() }}
	</div>
@stop