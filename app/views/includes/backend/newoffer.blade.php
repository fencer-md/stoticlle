@if ( isset($data['body']) )
    {{ $data['body'] }} with a rate of {{ round($data['rate'], 2)*100 }}%. This offer ends {{ $data['offer_ends'] }}
    {{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => 'form-horizontal']) }}
        {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
        {{ Form::submit('Approve', ['class' => 'btn default btn-xs blue']) }}
    {{ Form::close() }}
@elseif ( $lastInvest != null && $lastInvest->ammount >= 1000 && $lastInvest->confirmed == 0 )
    Wait for your offer
@else
    <div class="offer">
        <div class="desc">Панель инвестирования</div>
        <p class="information">Тут вы можете инвестировать в нашу систему деньги для того чтобы это сделать, пожалуйста
            введите в поле суму которую вы хотите инвестировать. </p>

        <div class="invest-plan">
            <div class="min-amount">
                <div class="lable">Минимальная сума:</div>
                <div class="number">$ {{ $data['default_min'] }}</div>
            </div>
            <div class="period">
                <div class="lable">Период :</div>
                <div class="number">{{ $data['default_period'] }} дней</div>
            </div>
            <div class="percent">
                <div class="lable">Процент :</div>
                <div class="number">{{ $data['default_rate'] }}%</div>
            </div>
        </div>
        <div class="clearfix">
            {{ Form::open(['action' => 'TransactionsController@investMoney', 'class' => 'form-horizontal', 'id' => 'invest-sidebar-form']) }}
            {{ Form::hidden('moneyAvailable', $moneyAvailable) }}
            <div class="input-group @if ($errors->has('ammount')) has-error @endif">
                <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                {{ Form::text('ammount', null, ['class' => 'form-control', 'id' => 'invest-sidebar-input']) }}
            </div>
            {{ Form::submit('OK', ['class' => 'btn default btn-xs blue', 'id' => 'invest-sidebar-button']) }}
            <div class="help-block">{{ $errors->first('ammount') }}</div>
            {{ Form::close() }}
        </div>
    </div>
@endif