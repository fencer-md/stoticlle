<div class="dashboard dashboard-user-sliding-menu pull-right">
    <div class="username username-hide-on-mobile pull-left">
        <span class="greetings hidden-xs">{{trans('menu.greetings')}}</span><span class="greeting visible-xs-inline-block">{{trans('menu.greeting')}}</span> <strong class="first_name" >{{ Auth::user()->userInfo->first_name }}</strong><strong class="last_name hidden-xs"> {{ Auth::user()->userInfo->last_name }}</strong>
    </div>
    <a href="{{ URL::to('logout') }}" class="icon hidden-xs"><i class="fa fa-sign-out"></i></a>
    <div class="dashboard-user-slide-menu user">
        <ul class="menu clearfix">
            <li class="user-menu-element"><a href="{{ URL::to('user/edit') }}"><span class="menu-title"><!-- Личный кабинет -->{{trans('menu.my_account')}}</span></a></li>
            <li class="user-menu-element"><a href="{{ URL::to('user/transactions') }}"><span class="menu-title"><!-- Транзакций -->{{trans('menu.transactions')}}</span></a></li>
            <li class="user-menu-element"><a href="{{ URL::to('user/addmoney') }}"><span class="menu-title"><!-- Пополнение средств -->{{trans('menu.add_money')}}</span></a></li>
            {{-- <li class="user-menu-element"><a href="{ { URL::to('user/withdraw') } }"><span class="menu-title">Вывод средств</span></a></li> --}}
            {{-- <li class="user-menu-element"><a href="{ { URL::to('bet') } }"><span class="menu-title">Ставки</span></a></li> --}}
            <li class="user-menu-element"><a href="{{ URL::to('user/announcements') }}"><span class="menu-title"><!-- Ставки -->{{trans('menu.bids')}}</span></a></li>
            <li class="user-menu-element visible-xs-block"><a href="{{ URL::to('logout') }}"><span class="menu-title"><!-- Выйти -->{{trans('menu.logout')}}</span></a></li>
        </ul>
    </div>
</div>
