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
<div class="side-bar-user">
    @include('announcements.user.notifications')
    @include('announcements.user.remaining')
	<div class="special-news">
		<div class="header">{{trans('userpage.specialnews')}}</div>
		<div class="news">
			<span class="date" style="color: #00FF47;font-weight: 900;">23.04.2015</span><div >{{trans('news.latest')}}</div>
		</div>
		<!--
<div class="news">
			<span class="date">12.03.2014</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		</div>
-->
	</div>
</div>
@endif
