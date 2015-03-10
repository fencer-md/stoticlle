@extends('layouts.backend.base')

@section('content')
<div class="center-big-width clearfix">
    <!-- <h3 class="page-title">Withdraw money</h3> -->
    <!-- <div class="row"> -->
      <div class="col-lg-6 help clearfix">
        <div class="title">Как снять деньги?</div>
        <p class="description">
        Для пополнения средств на платворму, вам необходимо иметь один из перечисленых Электроных кошельков:</p>
        <div class="col-md-6">
        	<ul>
            <li>OK Pay</li>
            <li>Payeer</li>
            <li>Payza</li>
            <li>Perfect Money</li>
				  </ul>
				</div>
        <div class="col-md-6">
          <ul>
            <li>Qiwi</li>
            <li>Skrill</li>
            <li>WebMoney</li>
            <li>Yandex</li>
          </ul>
        </div>
        <p class="description">Отметьте галочкой какой электроный кошелек вы хотите использывать для перевода, в поле <span>реквезиты</span> впишите ваш номер кошелька который вы будете использывать и в графе <span>сумма</span> впишите сумму которую вы хотите перевести.
        </p>
      </div>
			<div class="portlet box blue col-lg-6">
				<div class="portlet-title"><div class="caption">Пополнение Средств</div></div>
				<div class="portlet-body form">
      		{{ Form::open(['action' => 'TransactionsController@withdrawRequest', 'class' => 'form-horizontal']) }}
            {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
            {{ Form::hidden('payment_title') }}
            {{ Form::hidden('payment_credentials') }}
            <div class="form-body col-md-12">
                
                    <div class="form-group"> 
                        {{ Form::label('add_method', 'Выбрать метод', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            <div class="radio-list withdraw-wallets"> 
<!-- Needs to be created a new araay based on this:
 																@foreach ( $payments as $payment )
                                    @if ( $payment->title == 'webmoney' )
                                        <div><label class="radio"><span>{{ Form::radio('withdraw_method', 'webmoney', ['selected'=>'selected']) }}</span><img src="{{ URL::asset('images/payments/webmoney.png') }}"><div class="credentials">{{ $payment->account_id }}</div>{{ Form::hidden('payment_method_id', $payment->id) }}</label></div> 
                                    @elseif ( $payment->title == 'paypal' )
                                        <div><label class="radio"><span>{{ Form::radio('withdraw_method', 'paypal') }}</span><img src="{{ URL::asset('images/payments/paypal.png') }}"><div class="credentials">{{ $payment->account_id }}</div>{{ Form::hidden('payment_method_id', $payment->id) }}</label></div>
                                    @elseif ( $payment->title == 'cards' )                                    
                                        <div><label class="radio"><span>{{ Form::radio('withdraw_method', 'cards') }}</span><img src="{{ URL::asset('images/payments/cards.png') }}"><div class="credentials">{{ $payment->account_id }}</div>{{ Form::hidden('payment_method_id', $payment->id) }}</label></div>
                                    @endif
                                @endforeach
    So it chould be possible to create a ncie select list like:
-->
 														<?php $options = array(
 																										/*In every <option> */"'Payment image' 'Payment id'"
 														); ?>
                           {{ Form::select('payments',$options, 'selected',['class' => 'nice-select'] )}}


                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('credentials', 'Реквезиты', ['class' => 'control-label col-md-3']) }}
                        <div class="controls">
                            <div class="col-md-9">
                              {{ Form::text('credentials', '', ['class' => 'form-control', 'data-placeholder' => "Insert your credentials"]) }}
                            </div>
                          
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('ammount', 'Сумма вывода($)', ['class' => 'control-label col-md-3']) }}
                        <div class="controls">
                            <div class="col-md-9">
                              {{ Form::text('ammount', null, ['class' => 'form-control']) }}
                            </div>
                          
                        </div>
                    </div>
                    <div class="pull-right col-xs-3">
											{{ Form::submit('Изъять', ['class' => 'btn blue pull-right']) }} 
                    </div>  
            </div>
        {{ Form::close() }}
			</div>
			</div>
	<!-- </div> -->
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