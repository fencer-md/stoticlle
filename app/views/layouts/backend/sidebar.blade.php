<ul class="page-sidebar-menu">
    @if ( Auth::user()->role == "1" )
		<li class="avlb-amount">Users: {{ $data['adminUsersRegistered'] }}</li>
		<li class="avlb-amount">Money in the system: {{ $data['adminTotalSum'] }}$</li>
		<li class="avlb-amount">Total invested: {{ $data['adminTotalInvestedSum'] }}$</li>
		<li class="avlb-amount">Total rewarded: {{ $data['adminTotalRewardedSum'] }}$</li>
		<li class="avlb-amount">Cycles: {{ $data['adminCyclesFinished'] }}$</li>
	@endif
    @if ( Auth::user()->role == "2" )
		<li class="name">Hello {{ Auth::user()->userInfo->first_name }}</li>
		<li class="avlb-amount">Available amount: {{ $data['userMoneyAvailable'] }}$</li>
	@endif
</ul>