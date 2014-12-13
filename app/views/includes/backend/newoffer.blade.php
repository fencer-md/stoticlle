@if ( $data != null )
	{{ $data['body'] }} with a rate of {{ round($data['rate'], 2)*100 }}%. This offer ends {{ $data['offer_ends'] }}
    {{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => 'form-horizontal']) }}
        {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
        {{ Form::submit('Approve', ['class' => 'btn default btn-xs blue']) }}
    {{ Form::close() }}
@elseif ( $lastInvest != null && $lastInvest->ammount >= 1000 && $lastInvest->confirmed == 0 )
    Wait for your offer
@elseif ( $data == null )
<div class="offer">    <div class="desc">Панель инвестирования</div>
<p class="information">Тут вы можете инвестировать в нашу систему деньги для того чтобы это сделать, пожалуйста введите в поле суму которую вы хотите инвестировать. </p>
<div class="invest-plan">
	<div class="min-amount"><div class="lable">Минимальная сума: </div><div class="number">$ 100</div></div>
	<div class="period"><div class="lable">Период :</div><div class="number">26 дней</div></div>
	<div class="percent"><div class="lable">Процент :</div><div class="number">20%</div></div>
</div>
        {{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => 'form-horizontal', 'id' => 'invest-sidebar-form']) }}
                {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
                <div class="input-group"><span class="input-group-addon">
											<i class="fa fa-usd"></i>
											</span>{{ Form::text('ammount', null, ['class' => 'form-control', 'id' => 'invest-sidebar-input']) }}</div>
            {{ Form::submit('OK', ['class' => 'btn default btn-xs blue', 'id' => 'invest-sidebar-button']) }}
        {{ Form::close() }}</div>
@endif