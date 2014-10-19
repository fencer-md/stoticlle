{{-- <div class="profile">
	<div class="name">Hello {{ Auth::user()->userInfo->first_name }}</div>
	@if ( Auth::user()->role == '2' )
		<div class="avlb-amount">Available amount: {{ $data }}$</div>
	@endif
</div> --}}
<li class="dropdown">
  <a href="{{ URL::to('user/edit') }}" class="dropdown-toggle simple-link">
  	<span class="menu-title">
  		Profile
  	</span>
  </a>
</li>
@if ( Auth::user()->role == "1" )
	<li class="dropdown">
	  <a href="#" class="dropdown-toggle simple-dropdown" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
	  	<span class="menu-title">
	  		Manage users
	  	</span>
	  	<i class="fa fa-angle-down"></i>
	  </a>
	  <ul class="dropdown-menu">
			<li>
				<a href="{{ URL::to('user/admin/userlist') }}">
					See all users
				</a>
			</li>
			<li>
				<a href="{{ URL::to('user/admin/userlistnew') }}">
					Recently joined
				</a>
			</li>
			<li>
				<a href="{{ URL::to('user/admin/investors') }}">
					Investors
				</a>
			</li>
			<li>
				<a href="{{ URL::to('user/admin/awarded') }}">
					Awarded
				</a>
			</li>
			<li>
				<a href="#">
					Next step users
				</a>
			</li>
			<li>
				<a href="{{ URL::to('user/admin/edituserlist') }}">
					Manage users
				</a>
			</li>
			<li>
				<a href="{{ URL::to('user/admin/monitored') }}">
					Monitored users
				</a>
			</li>
	  </ul>			
	</li>
	<li class="dropdown">
	  <a href="#" class="dropdown-toggle simple-dropdown" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
	  	<span class="menu-title">
	  		Transactions
	  	</span>
	  	<i class="fa fa-angle-down"></i>
	  </a>
	  <ul class="dropdown-menu">
			<li>
				<a href="{{ URL::to('user/admin/transactions/all') }}">
					All transactions
				</a>
			</li>
			<li>
				<a href="{{ URL::to('user/admin/funds') }}">
					Funding
				</a>
			</li>	
			<li>
				<a href="{{ URL::to('user/admin/investments/all') }}">
					Invested money
				</a>
			</li>	
			<li>
				<a href="{{ URL::to('user/admin/earned/all') }}">
					Earned money
				</a>
			</li>	
			<li>
				<a href="#">
					Cash out request
				</a>
			</li>	
			<li>
				<a href="#">
					Refused transactions
				</a>
			</li>	
			<li>
				<a href="#">
					Waiting for action
				</a>
			</li>	
	  </ul>
	</li>
@endif
@if ( Auth::user()->role == "2" )
	<li class="dropdown">
	  <a href="{{ URL::to('user/edit') }}" class="dropdown-toggle simple-link">
	  	<span class="menu-title">
	  		Profile
	  	</span>
	  </a>
	</li>
	<li class="dropdown">
	  <a href="{{ URL::to('user/transactions') }}" class="dropdown-toggle simple-link">
	  	<span class="menu-title">
	  		Transactions
	  	</span>
	  </a>
	</li>
	<li class="dropdown">
	  <a href="{{ URL::to('user/invest') }}" class="dropdown-toggle simple-link">
	  	<span class="menu-title">
	  		Invest
	  	</span>
	  </a>
	</li>
	<li class="dropdown">
	  <a href="{{ URL::to('user/addmoney') }}" class="dropdown-toggle simple-link">
	  	<span class="menu-title">
	  		Add money
	  	</span>
	  </a>
	</li>
@endif
<li class="dropdown">
  <a href="{{ URL::to('logout') }}" class="dropdown-toggle simple-link">
  	<span class="menu-title">
  		Logout
  	</span>
  </a>
</li>