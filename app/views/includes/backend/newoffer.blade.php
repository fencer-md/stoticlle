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
        {{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => 'form-horizontal', 'id' => 'invest-sidebar-form']) }}
                {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
                {{ Form::text('ammount', null, ['class' => 'form-control', 'id' => 'invest-sidebar-input']) }}
            {{ Form::submit('Approve', ['class' => 'btn default btn-xs blue', 'id' => 'invest-sidebar-button']) }}
        {{ Form::close() }}
@endif