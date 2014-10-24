@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title"><b>{{ $data['user']['email'] }}</b> transaction history</h3>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <td>Transaction ID</td>
                <td>Date</td>
                <td>Direction</td>
                <td>Payment method</td>
                <td>Ammount</td>
                @if ( Request::is('user/admin/cashoutlist') )
                    <td>Approve</td>
                @elseif ( Request::is('user/admin/addmoneyrequests') )
                    <td>Confirm</td>
                @endif
            </thead>
            <tbody>
        @foreach ( $data['transactions'] as $transaction )
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->transaction_direction }}</td>
                    <td>@if ( $transaction->payment_method == NULL )
                            System
                        @else
                            {{ $transaction->payment_method }}
                        @endif
                    </td>
                    <td>{{ $transaction->ammount }}</td>
                    @if ( Request::is('user/admin/cashoutlist/pending') )
                        @if ( $transaction->transaction_direction == 'cash out' )
                            <td>
                                {{ Form::open(['action' => 'TransactionsController@cashOutRequestStatus', 'class' => 'form-horizontal']) }}
                                    {{ Form::hidden('tid', $transaction->id) }}
                                    {{ Form::hidden('status', 1) }}
                                    {{ Form::submit('Approve', ['class' => 'btn default btn-xs blue']) }}
                                {{ Form::close() }}
                                {{ Form::open(['action' => 'TransactionsController@cashOutRequestStatus', 'class' => 'form-horizontal']) }}
                                    {{ Form::hidden('tid', $transaction->id) }}
                                    {{ Form::hidden('status', 0) }}
                                    {{ Form::submit('Not approved', ['class' => 'btn default btn-xs red']) }}
                                {{ Form::close() }}
                            </td>
                        @else
                            <td>-</td>
                        @endif
                    @elseif ( Request::is('user/admin/addmoneyrequests') )
                        <td>
                            <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/addmoneyrequest?tid='.$transaction->id.'&uid='.$transaction->user_id) }}" data-target="#info-dialog"><i class="fa fa-edit"></i>Offer</a>
                        </td>
                    @elseif ( Request::is('user/admin/moneyrecieved') )
                        <td>
                            {{ Form::open(['action' => 'TransactionsController@addMoneyRequestConfirm', 'class' => 'form-horizontal']) }}
                                {{ Form::hidden('tid', $transaction->id) }}
                                {{ Form::hidden('uid', $transaction->user_id) }}
                                {{ Form::submit('Confirm', ['class' => 'btn default btn-xs purple']) }}
                            {{ Form::close() }}
                        </td>       
                    @elseif ( Request::is('user/admin/withdrawrequest') )
                        <td>
                            {{ Form::open(['action' => 'TransactionsController@usersWithdrawMoneyConfirm', 'class' => 'form-horizontal']) }}
                                {{ Form::hidden('tid', $transaction->id) }}
                                {{ Form::hidden('uid', $transaction->user_id) }}
                                {{ Form::hidden('ammount', $transaction->ammount) }}
                                {{ Form::submit('Confirm', ['class' => 'btn default btn-xs purple']) }}
                            {{ Form::close() }}
                        </td>               
                    @endif
                </tr>
        @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="info-dialog" tabindex="-1" role="dialog" aria-labelledby="award" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            </div>
          </div>
        </div>
@stop