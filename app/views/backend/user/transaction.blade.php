@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">User transactions</h3>
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
		<br>
	</div>
@stop