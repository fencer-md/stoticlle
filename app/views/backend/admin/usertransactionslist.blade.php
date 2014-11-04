@extends('layouts.backend.base')

@section('content')
    @if ( Request::is('user/admin/transactions/*') && !Request::is('user/admin/transactions/all') )
        <h3 class="page-title"><b>{{ $user->email }}</b> transaction history</h3>
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
                <td>
                    @if ($sortby == 'users_transaction.id' && $order == 'desc')
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Transaction ID', ['uid' => $uid, 'sortby' => 'users_transaction.id', 'order' => 'asc']) }}
                    @else
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Transaction ID', ['uid' => $uid, 'sortby' => 'users_transaction.id', 'order' => 'desc']) }}
                    @endif
                </td>
                <td>
                    @if ($sortby == 'users.email' && $order == 'desc')
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Email', ['uid' => $uid, 'sortby' => 'users.email', 'order' => 'asc']) }}
                    @else
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Email', ['uid' => $uid, 'sortby' => 'users.email', 'order' => 'desc']) }}
                    @endif
                </td>
                <td>
                    @if ($sortby == 'users_transaction.date' && $order == 'desc')
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Date', ['uid' => $uid, 'sortby' => 'users_transaction.date', 'order' => 'asc']) }}
                    @else
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Date', ['uid' => $uid, 'sortby' => 'users_transaction.date', 'order' => 'desc']) }}
                    @endif
                </td>
                <td>
                    @if ($sortby == 'users_transaction.transaction_direction' && $order == 'desc')
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Type', ['uid' => $uid, 'sortby' => 'users_transaction.transaction_direction', 'order' => 'asc']) }}
                    @else
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Type', ['uid' => $uid, 'sortby' => 'users_transaction.transaction_direction', 'order' => 'desc']) }}
                    @endif
                </td>
                <td>
                    @if ($sortby == 'users_transaction.payment_system' && $order == 'desc')
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Wallet', ['uid' => $uid, 'sortby' => 'users_transaction.payment_system', 'order' => 'asc']) }}
                    @else
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Wallet', ['uid' => $uid, 'sortby' => 'users_transaction.payment_system', 'order' => 'desc']) }}
                    @endif
                </td>
                @if ( Request::is('user/admin/transactions/*') )
                    <td>
                        @if ($sortby == 'payment_methods.account_id' && $order == 'desc')
                            {{ HTML::linkAction('TransactionsController@'.$controller, 'Credentials', ['uid' => $uid, 'sortby' => 'payment_methods.account_id', 'order' => 'asc']) }}
                        @else
                            {{ HTML::linkAction('TransactionsController@'.$controller, 'Credentials', ['uid' => $uid, 'sortby' => 'payment_methods.account_id', 'order' => 'desc']) }}
                        @endif
                    </td>
                @endif
                <td>
                    @if ($sortby == 'users_transaction.ammount' && $order == 'desc')
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Ammount', ['uid' => $uid, 'sortby' => 'users_transaction.ammount', 'order' => 'asc']) }}
                    @else
                        {{ HTML::linkAction('TransactionsController@'.$controller, 'Ammount', ['uid' => $uid, 'sortby' => 'users_transaction.ammount', 'order' => 'desc']) }}
                    @endif
                </td>
                @if ( Request::is('user/admin/cashoutlist') )
                    <td>Approve</td>
                @elseif ( Request::is('user/admin/addmoneyrequests') || Request::is('user/admin/withdrawrequests') )
                    <td>
                        @if ($sortby == 'payment_methods.from_credentials' && $order == 'desc')
                            {{ HTML::linkAction('TransactionsController@'.$controller, 'Credentials from', ['uid' => $uid, 'sortby' => 'payment_methods.from_credentials', 'order' => 'asc']) }}
                        @else
                            {{ HTML::linkAction('TransactionsController@'.$controller, 'Credentials from', ['uid' => $uid, 'sortby' => 'payment_methods.from_credentials', 'order' => 'desc']) }}
                        @endif
                    </td>
                    <td>Confirm</td>
                @elseif ( Request::is('user/admin/moneyrecieved') )
                    <td>
                        @if ($sortby == 'payment_methods.account_id' && $order == 'desc')
                            {{ HTML::linkAction('TransactionsController@'.$controller, 'Credentials from', ['uid' => $uid, 'sortby' => 'payment_methods.account_id', 'order' => 'asc']) }}
                        @else
                            {{ HTML::linkAction('TransactionsController@'.$controller, 'Credentials from', ['uid' => $uid, 'sortby' => 'payment_methods.account_id', 'order' => 'desc']) }}
                        @endif
                    </td>
                    <td>
                        @if ($sortby == 'users_transaction.to_credentials' && $order == 'desc')
                            {{ HTML::linkAction('TransactionsController@'.$controller, 'Credentials to', ['uid' => $uid, 'sortby' => 'users_transaction.to_credentials', 'order' => 'asc']) }}
                        @else
                            {{ HTML::linkAction('TransactionsController@'.$controller, 'Credentials to', ['uid' => $uid, 'sortby' => 'users_transaction.to_credentials', 'order' => 'desc']) }}
                        @endif
                    </td>
                    <td>Confirm</td>
                @endif
            </thead>
            <tbody>
        @foreach ( $transactions as $transaction )
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->user->email }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->transaction_direction }}</td>
                    <td>@if ( $transaction->payment_system == NULL )
                            -
                        @else
                            {{ $transaction->payment_system }}
                        @endif
                    </td>
                    @if ( Request::is('user/admin/transactions/*') )
                        @if ( $transaction->transactionFrom == null )
                            <td>-</td>
                        @else
                            <td>{{ $transaction->account_id }}</td>
                        @endif
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