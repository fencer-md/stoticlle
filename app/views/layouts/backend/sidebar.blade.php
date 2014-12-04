<ul class="page-sidebar-menu">
    @if ( Auth::user()->role == "1" )
		<li class="dashboard-stat purple-plum avlb-amount">
			<div class="visual">
				<i class="fa fa-globe"></i>
			</div>
			<div class="details">
				<div class="number">{{ round($data['usersRegistered'], 2) }}</div>
				<div class="desc">Users</div>
			</div>
		</li>
		<li class="dashboard-stat purple-plum avlb-amount">		
			<div class="visual">
				<i class="fa fa-globe"></i>
			</div>
			<div class="details">
				<div class="number">{{ round($data['currentAmmount'], 2) }}$</div>
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
		<li class="name">Hello {{ Auth::user()->userInfo->first_name }}</li>
		<li class="dashboard-stat purple-plum avlb-amount">
			<div class="visual">
				<i class="fa fa-globe"></i>
			</div>
			<div class="details">
				<div class="number">{{ round($data['currentAmmount'], 2) }}$</div>
				<div class="desc">Available ammount</div>
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
				<div class="number">{{ round($data['lastInvestedAmmount'], 2) }}$</div>
				<div class="desc">Current invested</div>
			</div>
		</li>
    	@if ( Auth::user()->awaiting_award == "1" )
			<li class="cycle-end">At the end of the cycle you will recieve: @include('includes.backend.cycles')</li>
		@endif
    	@if ( Auth::user()->awaiting_award == "0" )
			<li class="cycle-end">@include('includes.backend.newoffer')</li>
		@endif
	@endif
</ul>