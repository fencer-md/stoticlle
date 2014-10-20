@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title"><b>{{ $data['user']['email'] }}</b> transaction history</h3>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <td>Transaction ID</td>
                <td>Date</td>
                <td>Transaction type</td>
                <td>Payment method</td>
                <td>Direction</td>
                <td>Ammount</td>
                @if ( Request::is('user/admin/cashoutlist') )
                    <td>Approve</td>
                @endif
            </thead>
            <tbody>
        @foreach ( $data['transactions'] as $transaction )
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->transaction_type }}</td>
                    <td>@if ( $transaction->payment_method == NULL )
                            System
                        @else
                            {{ $transaction->payment_method }}
                        @endif
                    </td>
                    <td>{{ $transaction->transaction_direction }}</td>
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
                    @endif
                </tr>
        @endforeach
            </tbody>
        </table>
@stop