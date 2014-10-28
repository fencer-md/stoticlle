@extends('layouts.backend.base')

@section('content')
    @if ( Session::get('msg') )
        <div class="note note-danger">{{ Session::get('msg') }}</div>
    @endif
    <h3 class="page-title">Add money to your account</h3>
    <div class="row">
        {{ Form::open(['action' => 'TransactionsController@addMoneyToAccount', 'class' => 'form-horizontal']) }}
            <div class="form-body col-md-12">
                <div class="col-md-6">
                    <div class="form-group"> 
                        {{ Form::label('add_method', 'Add method', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-9">
                            <div class="radio-list">
                                <div><label class="radio"><span>{{ Form::radio('add_method', 'webmoney', ['selected'=>'selected']) }}</span><img src="{{ URL::asset('images/payments/webmoney.png') }}"></label></div> 
                                <div><label class="radio"><span>{{ Form::radio('add_method', 'paypal') }}</span><img src="{{ URL::asset('images/payments/paypal.png') }}"></label></div>
                                <div><label class="radio"><span>{{ Form::radio('add_method', 'cards') }}</span><img src="{{ URL::asset('images/payments/cards.png') }}"></label></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('credentials', 'Credentials', ['class' => 'control-label']) }}
                        <div class="controls">
                            <div class="col-md-4">
                              {{ Form::text('credentials', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('add_money', 'Ammount to add', ['class' => 'control-label']) }}
                        <div class="controls">
                            <div class="col-md-4">
                              {{ Form::text('add_money', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::submit('Submit', ['class' => 'btn blue']) }}
                </div>
                <div class="col-md-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et imperdiet neque, ut pharetra libero. Maecenas accumsan hendrerit semper. Nullam vestibulum diam ut elit iaculis condimentum vitae in erat. Aliquam venenatis, nulla tincidunt lacinia tincidunt, mi felis pharetra erat, sit amet mollis justo arcu vel nisl. Quisque luctus finibus turpis, et aliquam libero tempor sit amet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus commodo orci at gravida venenatis. Curabitur laoreet nulla et malesuada faucibus. Vestibulum tincidunt ligula est, nec faucibus lectus fringilla non.
                </div>
            </div>  
        {{ Form::close() }}
    </div>
@stop