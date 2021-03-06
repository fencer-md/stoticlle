@extends('layouts.backend.base')

@section('content')
@if ( Session::get('msg') )
<div class="note note-danger">{{ Session::get('msg') }}</div>
@endif

<div class="center-big-width clearfix">
<div class="col-lg-6 help clearfix">
    <div class="title">{{trans('userpage.howto')}}</div>
    <p class="description">{{trans('userpage.howtotop')}}</p>
    <div class="col-md-6">
      <ul>
         <li>PAYPAL</li>
		  </ul>
				</div>
        <div class="col-md-6">
          <ul>
                    <li>WEBMONEY</li>
          </ul>
        </div>
        <p class="description">{{trans('userpage.howtobottom')}}</p>
</div>
<div class="portlet box blue col-lg-6">
    <div class="portlet-title"><div class="caption">{{trans('userpage.addfunds')}}</div></div>
    <div class="portlet-body form">
        {{ Form::open(['action' => 'TransactionsController@addMoneyToAccount', 'class' => 'form-horizontal', 'id' => 'add-money-form']) }}
        <div class="form-body col-md-12">

            <div class="form-group @if ($errors->has('add_method')) has-error @endif">
                {{ Form::label('add_method', Lang::get('userpage.paymantways'), ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-9" id="payment_methods">
                    <div class="radio-list col-xs-12 row">
                        @foreach(Helper::paymentMethods() as $id => $method)
                        <div class="radio-pay">
                            <label class="radio" @if (!empty($wallets[$id])) data-wallet="{{ $wallets[$id] }}" @endif>
                                <span>{{ Form::radio('add_method', $id) }}</span>
                                <img class="pay-logo" src="{{ URL::asset('backend/img/pay_met/' . $id . '.png') }}">
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="help-block">{{ $errors->first('add_method') }}</div>
                </div>
            </div>
            <div class="form-group credentials @if ($errors->has('credentials')) has-error @endif">
                {{ Form::label('credentials', Lang::get('userpage.requisites'), ['class' => 'control-label col-md-3']) }}
                <div class="controls">
                    <div class="col-md-9">
                        {{ Form::text('credentials', '', ['class' => 'form-control', 'data-placeholder' => "Insert your credentials"]) }}
                        <div class="help-block">{{ $errors->first('credentials') }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group has-feedback ammount  @if ($errors->has('add_money')) has-error @endif">
                {{ Form::label('add_money', Lang::get('userpage.sum2'), ['class' => 'control-label col-md-3']) }}
                <div class="controls">
                    <div class="col-md-9">
                      {{ Form::text('add_money', '25', ['class' => 'form-control']) }}
                        <div class="help-block">{{ $errors->first('add_money') }}</div>
                    </div>
                </div>
            </div>
            <div class="pull-right col-xs-3">
							{{ Form::submit(Lang::get('userpage.add'), ['class' => 'btn blue pull-right']) }}
            </div>
      </div>

  </div>  
  {{ Form::close() }}
</div>
</div>
@stop
@section('custom_scripts')
// <script type="text/javascript">
//     $(document).ready(function(){
//         $('#payment_methods label.radio').click(function(){
//             var $this = $(this);
//             if ($this.data('wallet')) {
//                 $('#credentials').val($this.data('wallet'));
//             } else {
//                 $('#credentials').val('');
//             }
//         });

//         // TODO: Add proper form validation.
//         $('form#add-money-form ').submit(function(e) {
//             $('.error-addmoney').remove();
//             if ( $('.selectize-input > div').text().length == 0 ) {
//                 e.preventDefault();
//                 $('form#add-money-form .credentials').addClass('has-error');
//             }
//             if ( $('input#add_money').val() == '' ) {
//                 e.preventDefault();
//                 $('form#add-money-form .ammount').addClass('has-error');
//             }
//         });
//     });
// </script>
@stop