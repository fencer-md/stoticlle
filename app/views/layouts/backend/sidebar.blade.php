@if ( Auth::user()->role == "1" )
<ul class="page-sidebar-menu">
	<li class="dashboard-stat purple-plum avlb-amount pie-chart-sidebar">
		<div class="visual">
			<i class="fa fa-globe"></i>
		</div>
		<div class="details">
			<div class="number">
				<div class="easy-pie-chart">
					<div class="number transactions" data-percent="{{ round($data['usersRegistered'], 2) * 100 / 100 }}">
						<span>{{ round($data['usersRegistered'], 2) * 100 / 100 }} %</span>
					</div>
				</div>
			</div>
			<div class="desc">Users</div>
		</div>
	</li>
	<li class="dashboard-stat purple-plum avlb-amount money-total pie-chart-sidebar">		
		<div class="visual">
			<i class="fa fa-globe"></i>
		</div>
		<div class="details">
			<div class="number">
				<div class="easy-pie-chart">
					<div class="number transactions" data-percent="{{ round($data['currentAmmount'], 2) * 200000 / 100 }}">
						<span>{{ round($data['currentAmmount'], 2) * 200000 / 100 }} %</span>
					</div>
				</div>
			</div>
			<div class="desc">Money in the system</div>
		</div>
	</li>
	<li class="dashboard-stat purple-plum avlb-amount">		
		<div class="visual">
			<i class="fa fa-globe"></i>
		</div>
		<div class="details">
			<div class="number">{{ round($data['totalInvested'], 2) }}$</div>
			<div class="desc">Total invested</div>
		</div>
	</li>
	<li class="dashboard-stat purple-plum avlb-amount">		
		<div class="visual">
			<i class="fa fa-globe"></i>
		</div>
		<div class="details">
			<div class="number">{{ round($data['totalRewarded'], 2) }}$</div>
			<div class="desc">Total rewarded</div>
		</div>
	</li>
	<li class="dashboard-stat purple-plum avlb-amount">		
		<div class="visual">
			<i class="fa fa-globe"></i>
		</div>
		<div class="details">
			<div class="number">{{ $data['totalCycles'] }}</div>
			<div class="desc">Cycles</div>
		</div>
	</li>
</ul>
@endif
	
@if ( Auth::user()->role == "2" )
<!--

	<li class="dashboard-stat  avlb-amount">
		<div class="icon"> <i class="fa fa-usd"></i></div>
				<div class="number">{{ round($data['currentAmmount'], 2) }}$</div>
				<div class="desc">У вас на счету</div>
			
		</li>
		<li class="dashboard-stat  total-investment">
			<div class="icon"> <i class="fa fa-cloud-download"></i></div>
			<div class="desc">Всего инвестировано</div>
			<div class="number">{{ round($data['totalInvested'], 2) }}$</div>

		</li>
		<li class="dashboard-stat  total-reward">
			<div class="icon"> <i class="fa fa-cloud-upload"></i></div>
			<div class="desc">Всего прибыли</div>
			<div class="number">{{ round($data['totalRewarded'], 2) }}$</div>

		</li>
		
		@if ( Auth::user()->awaiting_award == "1" )
		<li class="dashboard-stat  current-invested">
			<div class="desc">Информация о инвестиций</div>
			<div class="end-date">
			<div class="day"><?php echo date("d"); ?></div>
			<div class="month"><?php echo date("M"); ?></div>
		</div>
			<div class="dates"><div class="invested">
				<div class="lable">Инвестировано</div>
				<div class="number">{{ round($data['lastInvestedAmmount'], 2) }}$</div>
			</div>
			<div class="will-be">
				<div class="lable">Прибыль</div>
				<div class="number"> @include('includes.backend.cycles')</div>
			</div>
		</div>
	</li>
		@endif
@if ( Auth::user()->awaiting_award == "0" )
<li class="cycle-end">@include('includes.backend.newoffer')</li>
@endif
-->
<div class="side-bar-user">
	<div class="warning">
		<div class="text">Внимание!</div>
		<div class="info">сейчас будет ставка</div>
	</div>
	<div class="remaining-time">
		<img src="{{ URL::asset('images/timer.png') }}" alt="timer">
		<div class="text">7 дней</div>
		<div class="info">осталось времени</div>
	</div>
	<div class="special-news">
		<div class="header">Спецыальные новости</div>
		<div class="news">
			<span class="date">12.03.2014</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
		<div class="news">
			<span class="date">12.03.2014</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
	</div>
</div>
@endif
