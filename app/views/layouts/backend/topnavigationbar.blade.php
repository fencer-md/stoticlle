@if ( Auth::user()->role == "1" )
<ul class="nav navbar-nav pull-right">
    <li class="dropdown">
        <a href="{{ URL::to('/') }}" class="dropdown-toggle simple-link" title="Домашняя">
            <i class="fa fa-home"></i>
        </a>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle simple-dropdown" data-toggle="dropdown" data-hover="dropdown"
           data-close-others="true">
            <span class="menu-title">Config</span>
            <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ URL::to('user/admin/config/rate') }}">Rate</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle simple-dropdown" data-toggle="dropdown" data-hover="dropdown"
           data-close-others="true">
            <span class="menu-title">Content</span>
            <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ URL::to('user/admin/pages') }}">Pages edit</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/blocks') }}">Front page blocks</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle simple-dropdown" data-toggle="dropdown" data-hover="dropdown"
           data-close-others="true">
            <span class="menu-title">Actions</span>
            <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ URL::to('user/admin/addmoneyrequests') }}">Request for funding</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/moneyrecieved') }}">Money recieved</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/withdrawrequests') }}">Withdraw request</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle simple-dropdown" data-toggle="dropdown" data-hover="dropdown"
           data-close-others="true">
            <span class="menu-title">Manage users</span>
            <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ URL::to('user/admin/userlist') }}">See all users</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/userlistnew') }}">Recently joined</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/investors') }}">Investors</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/nonactiveusers') }}">Didn't invest</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/awarded') }}">Awarded</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/nextstepusers') }}">Next step users</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/edituserlist') }}">Manage users</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/monitored') }}">Monitored users</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle simple-dropdown" data-toggle="dropdown" data-hover="dropdown"
           data-close-others="true">
            <span class="menu-title">Transactions</span>
            <i class="fa fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ URL::to('user/admin/transactions/all') }}">All transactions</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/funds') }}">Funding</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/investments/all') }}">Invested money</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/earned/all') }}">Earned money</a>
            </li>
            <li>
                <a href="{{ URL::to('user/admin/denied') }}">Refused transactions</a>
            </li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="{{ URL::to('admin/announcements') }}" class="simple-link dropdown-toggle">
            <span class="menu-title">Announcements</span>
        </a>
    </li>

    <li class="dropdown">
        <a href="{{ URL::to('logout') }}" class="dropdown-toggle simple-link" title="Выход">
            <i class="fa fa-sign-out"></i>
        </a>
    </li>
</ul>
@endif
@if ( Auth::user()->role == "2" )
<div class="dashboard dashboard-user-sliding-menu pull-right">
	<div class="username username-hide-on-mobile pull-left">
		<span class="greetings hidden-xs">Hello</span><span class="greeting visible-xs-inline-block">Hi</span> <strong class="first_name" >{{ Auth::user()->userInfo->first_name }}</strong><strong class="last_name hidden-xs"> {{ Auth::user()->userInfo->last_name }}</strong> 
	</div>
  <a href="{{ URL::to('logout') }}" class="icon hidden-xs"><i class="fa fa-sign-out"></i></a>
	<div class="dashboard-user-slide-menu user">
  	<ul class="menu clearfix">
  		<li class="user-menu-element"><a href="{{ URL::to('user/edit') }}"><span class="menu-title">Личный кабинет</span></a></li>
  		<!-- <li class="user-menu-element"><a href="{{ URL::to('user/transactions') }}"><span class="menu-title">Транзакций</span></a></li> -->
  		<li class="user-menu-element"><a href="{{ URL::to('user/addmoney') }}"><span class="menu-title">Пополнение средств</span></a></li>
  		<!-- <li class="user-menu-element"><a href="{{ URL::to('user/withdraw') }}"><span class="menu-title">Вывод средств</span></a></li> -->
  		<!-- <li class="user-menu-element"><a href="{{ URL::to('bet') }}"><span class="menu-title">Ставки</span></a></li> -->
  		<li class="user-menu-element"><a href="{{ URL::to('user/transactions') }}"><span class="menu-title">Ставки</span></a></li>
  		<li class="user-menu-element visible-xs-block"><a href="{{ URL::to('logout') }}"><span class="menu-title">Выйти</span></a></li>
  	</ul>
  </div>
</div>
@endif