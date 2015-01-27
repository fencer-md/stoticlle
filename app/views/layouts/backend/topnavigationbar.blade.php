@if ( Auth::user()->role == "1" )
<li class="dropdown">
  <a href="{{ URL::to('/') }}" class="dropdown-toggle simple-link">
  <i class="fa fa-home"></i>
  	<span class="menu-title">
  		Домашняя
  	</span>
  </a>
</li>

	<li class="dropdown">
	  	<a href="#" class="dropdown-toggle simple-dropdown" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
		  	<span class="menu-title">
		  		Config
		  	</span>
		  	<i class="fa fa-angle-down"></i>
	  	</a>
	  	<ul class="dropdown-menu">
			<li>
				<a href="{{ URL::to('user/admin/config/rate') }}">
					Rate
				</a>
			</li>
		</ul>
	</li>
	<li class="dropdown">
	  	<a href="#" class="dropdown-toggle simple-dropdown" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
		  	<span class="menu-title">
		  		Content
		  	</span>
		  	<i class="fa fa-angle-down"></i>
	  	</a>
	  	<ul class="dropdown-menu">
			<li>
				<a href="{{ URL::to('user/admin/pages') }}">
					Pages edit
				</a>
			</li>
			<li>
				<a href="{{ URL::to('user/admin/blocks') }}">
					Front page blocks
				</a>
			</li>
		</ul>
	</li>
	<li class="dropdown">
	  	<a href="#" class="dropdown-toggle simple-dropdown" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
		  	<span class="menu-title">
		  		Actions
		  	</span>
		  	<i class="fa fa-angle-down"></i>
	  	</a>
	  	<ul class="dropdown-menu">
			<li>
				<a href="{{ URL::to('user/admin/addmoneyrequests') }}">
					Request for funding
				</a>
			</li>
			<li>
				<a href="{{ URL::to('user/admin/moneyrecieved') }}">
					Money recieved
				</a>
			</li>
			<li>
				<a href="{{ URL::to('user/admin/withdrawrequests') }}">
					Withdraw request
				</a>
			</li>
		</ul>
	</li>
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
				<a href="{{ URL::to('user/admin/nonactiveusers') }}">
					Didn't invest
				</a>
			</li>	
			<li>
				<a href="{{ URL::to('user/admin/awarded') }}">
					Awarded
				</a>
			</li>
			<li>
				<a href="{{ URL::to('user/admin/nextstepusers') }}">
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
				<a href="{{ URL::to('user/admin/denied') }}">
					Refused transactions
				</a>
			</li>
	  </ul>
	</li>

<li class="dropdown">
	<a href="{{ URL::to('announcements') }}" class="simple-link dropdown-toggle">
		<span class="menu-title">Announcements</span>
	</a>
</li>

	<li class="dropdown">
  <a href="{{ URL::to('logout') }}" class="dropdown-toggle simple-link"><i class="fa fa-sign-out"></i>
  	<span class="menu-title">
  		Выход
  	</span>
  </a>
</li>

@endif
@if ( Auth::user()->role == "2" )
	

<!-- BEGIN USER LOGIN DROPDOWN -->
<li class="money">
				<div class="number">{{ round($data['currentAmmount'], 2) }} $</div></li>
				<li class="dropdown dropdown-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					
					<span class="username username-hide-on-mobile">
					{{ Auth::user()->userInfo->first_name }} {{ Auth::user()->userInfo->last_name }}</span>
<!-- 					<img alt="" class="img-circle hide1" src="/{{ Auth::user()->userInfo->photo }}"/> -->
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
					<li class="dropdown">
  <a href="{{ URL::to('/') }}" class="dropdown-toggle simple-link">
  <i class="fa fa-home"></i>
  	<span class="menu-title">
  		Домашняя
  	</span>
  </a>
</li>
						<li class="dropdown">
	  <a href="{{ URL::to('user/edit') }}" class="dropdown-toggle simple-link"><i class="fa fa-group"></i>
	  	<span class="menu-title">
	  		Личный кабинет
	  	</span>
	  </a>
	</li>
	<li class="dropdown">
	  <a href="{{ URL::to('user/transactions') }}" class="dropdown-toggle simple-link"><i class="fa fa-exchange"></i>
	  	<span class="menu-title">
	  		Транзакций
	  	</span>
	  </a>
	</li>
	<li class="dropdown">
	  <a href="{{ URL::to('user/addmoney') }}" class="dropdown-toggle simple-link"><i class="fa fa-download"></i>
	  	<span class="menu-title">
	  		Пополнение средств
	  	</span>
	  </a>
	</li>
	<li class="dropdown">
	  <a href="{{ URL::to('user/withdraw') }}" class="dropdown-toggle simple-link"><i class="fa fa-upload"></i>
	  	<span class="menu-title">
	  		Вывод средств
	  	</span>
	  </a>
	</li>
						<li class="divider">
						</li>
						<li class="dropdown">
  <a href="{{ URL::to('logout') }}" class="dropdown-toggle simple-link"><i class="fa fa-sign-out"></i>
  	<span class="menu-title">
  		Выход
  	</span>
  </a>
</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
				@endif