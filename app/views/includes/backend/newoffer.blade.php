@if ( $data != null )
	{{ $data['body'] }} with a rate of {{ round($data['rate'], 2)*100 }}%. This offer ends {{ $data['offer_ends'] }}
    {{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => 'form-horizontal']) }}
        {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
        {{ Form::submit('Approve', ['class' => 'btn default btn-xs blue']) }}
    {{ Form::close() }}
@elseif ( $lastInvest != null && $lastInvest->ammount >= 1000 && $lastInvest->confirmed == 0 )
    Wait for your offer
@elseif ( $data == null )
    How much do you want to invest?
    {{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => 'form-horizontal']) }}
        {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
        {{ Form::text('ammount', null, ['class' => 'form-control']) }}
        {{ Form::submit('Approve', ['class' => 'btn default btn-xs blue']) }}
    {{ Form::close() }}
@endif