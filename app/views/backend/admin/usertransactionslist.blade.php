@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title"><b>{{ $data['user']['email'] }}</b> transaction history</h3>
    @if ( Request::is('user/admin/transactions/*') )
        <div class="row user-info">
            <div class="name">{{ $data['user']['userInfo']['first_name'] }} {{ $data['user']['userInfo']['last_name'] }}</div>
            <div class="birth-date">{{ $data['user']['userInfo']['birth_date'] }}</div>
            <div class="country">{{ $data['user']['userInfo']['country'] }}</div>
            <div class="city">{{ $data['user']['userInfo']['city'] }}</div>
            <div class="commentary">
                {{ Form::open(['action' => 'UserController@updateCommentary', 'class' => 'form-horizontal']) }}
                    {{ Form::hidden('uid', $data['user']['id']) }}
                    {{ Form::textarea('user_commentary', $data['user']['commentary']) }}
                    {{ Form::submit('Save', ['class' => 'btn default btn-xs blue']) }}
                {{ Form::close() }}
            </div>
        </div>
    @endif
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <td>Transaction ID</td>
                <td>Email</td>
                <td>Date</td>
                <td>Type</td>
                <td>Wallet</td>
                @if ( Request::is('user/admin/transactions/*') )
                    <td>Credentials</td>
                @endif
                <td>Ammount</td>
                @if ( Request::is('user/admin/cashoutlist') )
                    <td>Approve</td>
                @elseif ( Request::is('user/admin/addmoneyrequests') || Request::is('user/admin/withdrawrequests') )
                    <td>Credentials from</td>
                    <td>Confirm</td>
                @elseif ( Request::is('user/admin/moneyrecieved') )
                    <td>Credentials from</td>
                    <td>Credentials to</td>
                    <td>Confirm</td>
                @endif
            </thead>
            <tbody>
        @foreach ( $data['transactions'] as $transaction )
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->user->email }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->transaction_direction }}</td>
                    <td>@if ( $transaction->payment_system == NULL )
                            System
                        @else
                            {{ $transaction->payment_system }}
                        @endif
                    </td>
                    @if ( Request::is('user/admin/transactions/*') && $transaction->transactionFrom != null )
                        <td>{{ $transaction->transactionFrom->account_id }}</td>
                    @endif
                    <td>{{ $transaction->ammount }}$</td>
                    @if ( Request::is('user/admin/addmoneyrequests') )
                        <td>{{ $transaction->transactionFrom->account_id }}</td>
                        <td>
                            <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/addmoneyrequest?tid='.$transaction->id.'&uid='.$transaction->user_id) }}" data-target="#info-dialog"><i class="fa fa-edit"></i>Approve</a>
                            {{ Form::open(['action' => 'TransactionsController@addMoneyRequestStatus', 'class' => 'form-horizontal']) }}
                                {{ Form::hidden('tid', $transaction->id) }}
                                {{ Form::hidden('uid', $transaction->user_id) }}
                                {{ Form::hidden('status', 'deny') }}
                                {{ Form::submit('Deny', ['class' => 'btn default btn-xs red']) }}
                            {{ Form::close() }}
                        </td>
                    @elseif ( Request::is('user/admin/withdrawrequests') )
                        <td>{{ $transaction->transactionFrom->account_id }}</td>
                        <td>
                            {{ Form::open(['action' => 'TransactionsController@usersWithdrawMoneyConfirm', 'class' => 'form-horizontal']) }}
                                {{ Form::hidden('tid', $transaction->id) }}
                                {{ Form::hidden('uid', $transaction->user_id) }}
                                {{ Form::hidden('status', 'allow') }}
                                {{ Form::submit('Confirm', ['class' => 'btn default btn-xs purple']) }}
                            {{ Form::close() }}
                            {{ Form::open(['action' => 'TransactionsController@usersWithdrawMoneyConfirm', 'class' => 'form-horizontal']) }}
                                {{ Form::hidden('tid', $transaction->id) }}
                                {{ Form::hidden('uid', $transaction->user_id) }}
                                {{ Form::hidden('status', 'deny') }}
                                {{ Form::submit('Deny', ['class' => 'btn default btn-xs red']) }}
                            {{ Form::close() }}
                        </td>
                    @elseif ( Request::is('user/admin/moneyrecieved') )
                        <td>{{ $transaction->transactionFrom->account_id }}</td>
                        <td>{{ $transaction->to_credentials }}</td>
                        <td>
                            {{ Form::open(['action' => 'TransactionsController@addMoneyRequestConfirm', 'class' => 'form-horizontal']) }}
                                {{ Form::hidden('tid', $transaction->id) }}
                                {{ Form::hidden('uid', $transaction->user_id) }}
                                {{ Form::hidden('status', 'allow') }}
                                {{ Form::submit('Confirm', ['class' => 'btn default btn-xs purple']) }}
                            {{ Form::close() }}
                            {{ Form::open(['action' => 'TransactionsController@addMoneyRequestConfirm', 'class' => 'form-horizontal']) }}
                                {{ Form::hidden('tid', $transaction->id) }}
                                {{ Form::hidden('uid', $transaction->user_id) }}
                                {{ Form::hidden('status', 'deny') }}
                                {{ Form::submit('Deny', ['class' => 'btn default btn-xs red']) }}
                            {{ Form::close() }}
                        </td>       
                    @elseif ( Request::is('user/admin/withdrawrequest') )
                        <td>
                            {{ Form::open(['action' => 'TransactionsController@usersWithdrawMoneyConfirm', 'class' => 'form-horizontal']) }}
                                {{ Form::hidden('tid', $transaction->id) }}
                                {{ Form::hidden('uid', $transaction->user_id) }}
                                {{ Form::hidden('ammount', $transaction->ammount) }}
                                {{ Form::hidden('status', 'allow') }}
                                {{ Form::submit('Confirm', ['class' => 'btn default btn-xs purple']) }}
                            {{ Form::close() }}
                            {{ Form::open(['action' => 'TransactionsController@usersWithdrawMoneyConfirm', 'class' => 'form-horizontal']) }}
                                {{ Form::hidden('tid', $transaction->id) }}
                                {{ Form::hidden('uid', $transaction->user_id) }}
                                {{ Form::hidden('ammount', $transaction->ammount) }}
                                {{ Form::hidden('status', 'deny') }}
                                {{ Form::submit('Deny', ['class' => 'btn default btn-xs red']) }}
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