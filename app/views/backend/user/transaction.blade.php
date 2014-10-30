@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">User transactions</h3>
    <div class="row">
		<table class="table table-striped table-hover">
			<thead>
                <td>Transaction ID</td>
                <td>Date</td>
                <td>Payment method</td>
                <td>Direction</td>
                <td>Credentials</td>
                <td>Ammount</td>
			</thead>
			<tbody>
		@foreach ( $data['transactions'] as $transaction )
				<tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>@if ( $transaction->payment_system == NULL )
                            System
                        @else
                            {{ $transaction->payment_system }}
                        @endif
                    </td>
                    <td>{{ $transaction->transaction_direction }}</td>
                    @if ( $transaction->transactionFrom != null )
                        <td>{{ $transaction->transactionFrom->account_id }}</td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ $transaction->ammount }}</td>
				</tr>
		@endforeach
			</tbody>
		</table>
		<br>
	</div>
@stop