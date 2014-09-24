<table>
	<thead>
		<td>Transaction ID</td>
		<td>Date</td>
		<td>Direction</td>
		<td>Ammount</td>
	</thead>
	<tbody>
@foreach ( $data['transactions'] as $transaction )
		<tr>
			<td>{{ $transaction->id }}</td>
			<td>{{ $transaction->date }}</td>
			<td>{{ $transaction->transaction_direction }}</td>
			<td>{{ $transaction->ammount }}</td>
		</tr>
@endforeach
	</tbody>
</table>
<br>
<div>Available amount: {{ $data['moneyAvailable'] }}$</div>
<br>
{{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => '']) }}
	{{ Form::label('invest_amount', 'Invest ammount') }}
    {{ Form::text('invest_amount') }}
    {{ Form::submit('Submit') }}	
{{ Form::close() }}
<br>
{{ Form::open(['action' => 'TransactionsController@addMoneyToAccount', 'class' => '']) }}
	{{ Form::label('add_money', 'Ammount to add') }}
    {{ Form::text('add_money') }}
    {{ Form::submit('Submit') }}	
{{ Form::close() }}