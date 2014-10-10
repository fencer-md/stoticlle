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
                </tr>
        @endforeach
            </tbody>
        </table>
        {{ Form::open(['action' => 'TransactionsController@moneyWon', 'class' => 'form-horizontal']) }}
            {{ Form::hidden('uid', $data['user']['id']) }}
            <div class="form-body col-md-3">
                <div class="form-group">
                    {{ Form::label('return_money', 'Ammount of money won', ['class' => 'control-label']) }}
                    <div class="controls">
                        <div class="col-md-9">
                          {{ Form::text('return_money', null, ['class' => 'form-control']) }}
                        </div>
                      {{ Form::submit('Submit', ['class' => 'btn blue']) }}
                    </div>
                </div>
            </div>
        {{ Form::close() }}
@stop