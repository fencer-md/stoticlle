<ul class="page-sidebar-menu">
    @if ( Auth::user()->role == "1" )
		<li class="avlb-amount">Users: {{ $data['usersRegistered'] }}</li>
		<li class="avlb-amount">Money in the system: {{ $data['currentAmmount'] }}$</li>
		<li class="avlb-amount">Total invested: {{ $data['totalInvested'] }}$</li>
		<li class="avlb-amount">Total rewarded: {{ $data['totalRewarded'] }}$</li>
		<li class="avlb-amount">Cycles: {{ $data['totalCycles'] }}</li>
	@endif
    @if ( Auth::user()->role == "2" )
		<li class="name">Hello {{ Auth::user()->userInfo->first_name }}</li>
		<li class="avlb-amount">Available amount: {{ $data['currentAmmount'] }}$</li>
		<li class="total-invested">Total invested: {{ $data['totalInvested'] }}$</li>
		<li class="total-rewarded">Total rewarded: {{ $data['totalRewarded'] }}$</li>
		<li class="current-invested">Current invested: {{ $data['lastInvestedAmmount'] }}$</li>
    	@if ( Auth::user()->awaiting_award == "1" )
			<li class="cycle-end">At the end of the cycle you will recieve: @include('includes.backend.cycles')</li>
		@endif
    	@if ( Auth::user()->awaiting_award == "0" )
			<li class="cycle-end">@include('includes.backend.newoffer')</li>
		@endif
	@endif
</ul>