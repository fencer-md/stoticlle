@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Invest money</h3>
    <div class="row">
		{{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => 'form-horizontal']) }}
            <div class="form-body col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('invest_amount', 'Ammount to invest', ['class' => 'control-label']) }}
                        <div class="controls">
                            <div class="col-md-3">
                              {{ Form::text('invest_amount', null, ['class' => 'form-control']) }}
                            </div>
                          {{ Form::submit('Submit', ['class' => 'btn blue']) }}
                        </div>
                    </div>
                </div> 
                <div class="col-md-6">
                    {{ $data->body }}
                </div>
            </div>
        {{ Form::close() }}
	</div>
@stop