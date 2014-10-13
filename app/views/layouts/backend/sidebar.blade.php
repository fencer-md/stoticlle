<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
	<li><a href="{{ URL::to('user/edit') }}"><span class="title"><i class="icon-user"></i> Edit profile</span></a></li>
    @if ( Auth::user()->role == "2" )
		<li><a href="{{ URL::to('user/transactions') }}"><span class="title"><i class="icon-refresh"></i> User transactions</span></a></li>
		<li><a href="{{ URL::to('user/invest') }}"><span class="title"><i class="icon-refresh"></i> Invest</span></a></li>
		<li><a href="{{ URL::to('user/addmoney') }}"><span class="title"><i class="icon-refresh"></i> Add money</span></a></li>
	@endif
    @if ( Auth::user()->role == "1" )
    	<li>
			<a href="javascript:;">
			<span class="title">Manage users</span>
			<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="{{ URL::to('user/admin/userlist') }}">See all users</a>
				</li>
				<li>
					<a href="#">Recently joined</a>
				</li>
				<li>
					<a href="#">Investors</a>
				</li>
				<li>
					<a href="#">Awarded</a>
				</li>
				<li>
					<a href="#">Next step users</a>
				</li>
				<li>
					<a href="#">Manage users</a>
				</li>
				<li>
					<a href="#">Monitored users</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:;">
			<span class="title">Transactions</span>
			<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="{{ URL::to('user/admin/transactions/all') }}">All transactions</a>
				</li>
				<li>
					<a href="#">Funding</a>
				</li>
				<li>
					<a href="{{ URL::to('user/admin/investments/all') }}">Invested money</a>
				</li>
				<li>
					<a href="{{ URL::to('user/admin/earned/all') }}">Earned money</a>
				</li>
				<li>
					<a href="#">Cash out request</a>
				</li>
				<li>
					<a href="#">Refused transactions</a>
				</li>
				<li>
					<a href="#">Waiting for action</a>
				</li>
			</ul>
		</li>
	@endif
	<li><a href="{{ URL::to('logout') }}"><span class="title">Logout</span></a></li>
</ul>