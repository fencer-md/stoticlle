@if ( $data == null )
	Invest up to 1000$ to get a daily rate of 2%.
    {{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => 'form-horizontal']) }}
        {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
        {{ Form::text('ammount', null, ['class' => 'form-control']) }}
        {{ Form::submit('Approve', ['class' => 'btn default btn-xs blue']) }}
    {{ Form::close() }}
@elseif ( $data != null )
	{{ $data['body'] }} with a rate of {{ round($data['rate'], 2)*100 }}. This offer ends {{ $data['offer_ends'] }}
    {{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => 'form-horizontal']) }}
        {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
        {{ Form::text('ammount', null, ['class' => 'form-control']) }}
        {{ Form::submit('Approve', ['class' => 'btn default btn-xs blue']) }}
    {{ Form::close() }}
@endif