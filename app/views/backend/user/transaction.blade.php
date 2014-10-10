@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">User transactions</h3>
    <div class="row-fluid">
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
		<br>
		<div>Available amount: {{ $data['moneyAvailable'] }}$</div>
		<br>
		{{ Form::open(['action' => 'TransactionsController@addMoneyToAccount', 'class' => 'form-horizontal']) }}
            <div class="form-body col-md-3">
                <div class="control-group">
        			{{ Form::label('add_money', 'Ammount to invest', ['class' => 'control-label']) }}
                    <div class="controls">
                        <div class="col-md-9">
            		      {{ Form::text('add_money', null, ['class' => 'form-control']) }}
                        </div>
                      {{ Form::submit('Submit', ['class' => 'btn blue']) }}
                    </div>
                </div>
            </div>	
		{{ Form::close() }}
	</div>
@stop