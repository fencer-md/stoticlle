@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Withdraw money</h3>
    <div class="row">
		{{ Form::open(['action' => 'TransactionsController@withdrawRequest', 'class' => 'form-horizontal']) }}
            {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
            {{ Form::hidden('payment_title') }}
            {{ Form::hidden('payment_credentials') }}
            <div class="form-body col-md-12">
                <div class="col-md-6">
                    <div class="form-group"> 
                        {{ Form::label('add_method', 'Add method', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-9">
                            <div class="radio-list withdraw-wallets">
                                @foreach ( $payments as $payment )
                                    @if ( $payment->title == 'webmoney' )
                                        <div><label class="radio"><span>{{ Form::radio('withdraw_method', 'webmoney', ['selected'=>'selected']) }}</span><img src="{{ URL::asset('images/payments/webmoney.png') }}"><div class="credentials">{{ $payment->account_id }}</div>{{ Form::hidden('payment_method_id', $payment->id) }}</label></div> 
                                    @elseif ( $payment->title == 'paypal' )
                                        <div><label class="radio"><span>{{ Form::radio('withdraw_method', 'paypal') }}</span><img src="{{ URL::asset('images/payments/paypal.png') }}"><div class="credentials">{{ $payment->account_id }}</div>{{ Form::hidden('payment_method_id', $payment->id) }}</label></div>
                                    @elseif ( $payment->title == 'cards' )                                    
                                        <div><label class="radio"><span>{{ Form::radio('withdraw_method', 'cards') }}</span><img src="{{ URL::asset('images/payments/cards.png') }}"><div class="credentials">{{ $payment->account_id }}</div>{{ Form::hidden('payment_method_id', $payment->id) }}</label></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean et imperdiet neque, ut pharetra libero. Maecenas accumsan hendrerit semper. Nullam vestibulum diam ut elit iaculis condimentum vitae in erat. Aliquam venenatis, nulla tincidunt lacinia tincidunt, mi felis pharetra erat, sit amet mollis justo arcu vel nisl. Quisque luctus finibus turpis, et aliquam libero tempor sit amet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus commodo orci at gravida venenatis. Curabitur laoreet nulla et malesuada faucibus. Vestibulum tincidunt ligula est, nec faucibus lectus fringilla non.
                </div>
            </div>
        {{ Form::close() }}
	</div>
@stop

@section('custom_scripts')
<script>
var base_title = $('.withdraw-wallets label.radio input[name="withdraw_method"]').val();
var base_value = $('.withdraw-wallets label.radio input[name="payment_method_id"]').val();
$('input[name="payment_title"]').val(base_title);
$('input[name="payment_credentials"]').val(base_value);
$('.withdraw-wallets label.radio').click(function() {
    base_value = $(this).find('input[name="payment_method_id"]').val();
    base_title = $(this).find('input[name="withdraw_method"]').val();
    $('input[name="payment_credentials"]').val(base_value);
    $('input[name="payment_title"]').val(base_title);
});
</script>
@stop