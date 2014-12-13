<ul class="page-sidebar-menu">
    @if ( Auth::user()->role == "1" )
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
	@endif
    @if ( Auth::user()->role == "2" )
		
		<li class="dashboard-stat  avlb-amount">
		<!--
<div class="icon"> <i class="fa fa-usd"></i></div>
				<div class="number">{{ round($data['currentAmmount'], 2) }}$</div>
				<div class="desc">У вас на счету</div>
-->
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
<div class="icon"> <i class="fa fa-usd"></i></div>
<div class="desc">Инвестиций в даный цикл</div>
				<div class="number">{{ round($data['lastInvestedAmmount'], 2) }}$</div>
<div class="icon"> <i class="fa fa-usd"></i></div>
<div class="desc">В конце цикла вы получите</div>
				<div class="number">{{ round($data['lastInvestedAmmount'], 2) }}$</div>
				
		</li>
			<li class="cycle-end">At the end of the cycle you will recieve: @include('includes.backend.cycles')</li>
		@endif
    	@if ( Auth::user()->awaiting_award == "0" )
			<li class="cycle-end">@include('includes.backend.newoffer')</li>
		@endif
	@endif
</ul>