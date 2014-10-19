@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Add money to your account</h3>
    <div class="row">
        {{ Form::open(['action' => 'TransactionsController@addMoneyToAccount', 'class' => 'form-horizontal']) }}
            <div class="form-body col-md-6">
                <div class="form-group"> 
                    {{ Form::label('add_method', 'Add method', ['class' => 'col-md-2 control-label']) }}
                    <div class="col-md-9">
                        <div class="radio-list">
                            <div><label class="radio"><span>{{ Form::radio('add_method', 'webmoney') }}</span><img src="{{ URL::asset('images/payments/webmoney.png') }}"></label></div> 
                            <div><label class="radio"><span>{{ Form::radio('add_method', 'paypal') }}</span><img src="{{ URL::asset('images/payments/paypal.png') }}"></label></div>
                            <div><label class="radio"><span>{{ Form::radio('add_method', 'cards') }}</span><img src="{{ URL::asset('images/payments/cards.png') }}"></label></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('add_money', 'Ammount to add', ['class' => 'control-label']) }}
                    <div class="controls">
                        <div class="col-md-4">
                          {{ Form::text('add_money', null, ['class' => 'form-control']) }}
                        </div>
                      {{ Form::submit('Submit', ['class' => 'btn blue']) }}
                    </div>
                </div>
            </div>  
        {{ Form::close() }}
    </div>
@stop