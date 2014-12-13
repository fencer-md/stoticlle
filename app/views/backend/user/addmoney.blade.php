@extends('layouts.backend.base')

@section('content')
    @if ( Session::get('msg') )
        <div class="note note-danger">{{ Session::get('msg') }}</div>
    @endif
    <h3 class="page-title">Add money to your account</h3>
    <div class="row">
        {{ Form::open(['action' => 'TransactionsController@addMoneyToAccount', 'class' => 'form-horizontal', 'id' => 'add-money-form']) }}
            <div class="form-body col-md-12">
                <div class="col-md-6">
                    <div class="form-group"> 
                        {{ Form::label('add_method', 'Add method', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-9" id="payment_methods">
                            <div class="radio-list">
                                @foreach(Helper::paymentMethods() as $id => $method)
                                    <div>
                                        <label class="radio" @if (!empty($wallets[$id])) data-wallet="{{ $wallets[$id] }}" @endif>
                                            <span>{{ Form::radio('add_method', $id) }}</span>
                                            <img src="{{ URL::asset('public/backend/img/pay_met/' . $id . '.png') }}">
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-feedback credentials">
                        {{ Form::label('credentials', 'Credentials', ['class' => 'control-label']) }}
                        <div class="controls">
                            <div class="col-md-6">
                                {{ Form::text('credentials', '', ['class' => 'form-control', 'data-placeholder' => "Insert your credentials"]) }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-feedback ammount">
                        {{ Form::label('add_money', 'Ammount to add $', ['class' => 'control-label']) }}
                        <div class="controls">
                            <div class="col-md-6">
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

@section('custom_scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#payment_methods label.radio').click(function(){
            var $this = $(this);
            if ($this.data('wallet')) {
                $('#credentials').val($this.data('wallet'));
            } else {
                $('#credentials').val('');
            }
        });

        // TODO: Add proper form validation.
        $('form#add-money-form ').submit(function(e) {
            $('.error-addmoney').remove();
            if ( $('.selectize-input > div').text().length == 0 ) {
                e.preventDefault();
                $('form#add-money-form .credentials').addClass('has-error');
            }
            if ( $('input#add_money').val() == '' ) {
                e.preventDefault();
                $('form#add-money-form .ammount').addClass('has-error');
            }
        });
    });
</script>
@stop