<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jarvis-Tech</title>

    <!-- Bootstrap -->
    @include('includes.frontend.styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="page-quick-sidebar-over-content">
    <header class="clearfix">
    <div class="logo-wrapper pull-left">
   	  <div class="header-logo">
   	  	<div class="pull-left sidebar-menu-button">
   	  		<span></span>
   	  		<span></span>
   	  		<span></span>
   	  	</div>
        <a href="/" class="logo-text"><img src="{{ URL::asset('images/logo.png') }}"></a>
		  </div>
      <!-- <div class="blurry"></div> -->  
    </div>
    
    <div class="user-slide-menu pull-right">
    	<div class="menu-toggler sidebar-toggler hide">
			<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
<!--     	<div class="row top-header"> -->
        <!-- <div class="col-md-2"><a href="/" class="logo-text"><img src="{{ URL::asset('images/logo.png') }}"></a></div> -->
        <!-- <div class="col-md-6">@include('announcements.ticker')</div> -->
        <!-- <div class="col-md-2"><select class="language-picker"><option>Руский</option><option>English</option><option>Romina</option></select></div>-->
        @if ( Auth::user() == null )
        <i class="fa fa-user"></i>
        <div class="login clearfix">
					<div id="login-register">
						<div class="text-right">
							 <div class="login-specific-button">{{trans('menu.login')}}</div>
							 <div class="login-form">           
                 {{ Form::open(['action' => 'SessionsController@store', 'class' => 'login-form']) }}
                     <div class="input-icon"><i class="fa fa-user"></i>{{ Form::text('email', null, ['placeholder' => 'E-mail', 'class'=>'form-control']) }}</div>
                     <div class="input-icon"><i class="fa fa-lock"></i>{{ Form::password('password', ['placeholder' => 'Пароль','class'=>'form-control']) }}</div>
                     <div class="form-actions">{{ Form::submit(Lang::get('menu.login'), ['class'=>'btn blue']) }}</div>
                     
                 {{ Form::close() }}
                 <div class="form-actions register-button">{{ Form::submit(Lang::get('menu.register'), ['id'=>'join'])}}</div>
               </div>
               <!-- <div class="register"> -->
                 <!-- <div class="login-msg" >вы еще не снами? <a id="join" href="#">Присоединяйтесь</a></div> -->
                <div class="register-specific-button">{{trans('menu.register')}}</div>
                <div class="register-form">
                   {{ Form::open(['action' => 'UserController@store', 'class' => 'form-signin']) }}
                       <div class="input-icon"><i class="fa fa-user"></i>{{ Form::text('email', null, ['placeholder' => 'E-mail','class'=>'form-control']) }}</div>
                       <div class="form-actions">{{ Form::submit(Lang::get('menu.registration'), ['class'=>'btn blue']) }}</div>
                   {{ Form::close() }}
               <!-- </div> -->
                </div>
            </div>
					</div>
        </div>
        @elseif ( Auth::user()->role == "2" )
        <div class="dashboard-user-sliding-menu pull-right">
					<div class="username username-hide-on-mobile pull-left">
						<span class="greetings">{{trans('menu.greetings')}}</span><span class="greeting">{{trans('menu.greeting')}}</span> <strong class="first_name" >{{ Auth::user()->userInfo->first_name }}</strong><strong class="last_name"> {{ Auth::user()->userInfo->last_name }}</strong> 
					</div>
					<a href="{{ URL::to('logout') }}" class="icon hidden-xs"><i class="fa fa-sign-out"></i></a>
					<div class="dashboard-user-slide-menu">
						<ul class="menu clearfix">
							<li class="user-menu-element"><a href="{{ URL::to('user/edit') }}">
                  <span class="menu-title">{{trans('menu.my_account')}}</span></a>
              </li>
							<li class="user-menu-element"><a href="{{ URL::to('user/transactions') }}">
                  <span class="menu-title">{{trans('menu.transactions')}}</span></a>
              </li>
							<li class="user-menu-element"><a href="{{ URL::to('user/addmoney') }}">
									<span class="menu-title">{{trans('menu.add_money')}}</span> </a>
              </li>
							<!--
<li class="user-menu-element"><a href="{{ URL::to('user/withdraw') }}">
                                    <span class="menu-title">{{trans('menu.withdraw')}}</span>
                                </a>
                            </li>
-->
							<li class="user-menu-element"><a href="{{ URL::to('bet') }}">
                  <span class="menu-title">{{trans('menu.bids')}}</span> </a>
              </li>
							<li class="user-menu-element visible-xs-block"><a href="{{ URL::to('logout') }}">
									<span class="menu-title"><!-- Выйти -->{{trans('menu.logout')}}</span></a>
							</li>
						</ul>
					</div>
				</div>
				@elseif ( Auth::user()->role == "1" )
				<div class="dashboard-user-sliding-menu admin pull-right">
					<ul class="nav navbar-nav pull-right">
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
            <i class="fa fa-sign-out visible-xs-inline-block visible-sm-inline-block"></i><span class="menu-title hidden-xs hidden-sm">Выход</span>
        </a>
    </li>
</ul>
				</div>
				@endif
        <a href="{{url('language', ['lang' => 'ru'])}}"><img src="{{asset('images/flags/ru.png')}}" alt="RU"></a>
        <a href="{{url('language', ['lang' => 'en'])}}"><img src="{{asset('images/flags/gb.png')}}" alt="EN"></a>
        <a href="{{url('language', ['lang' => 'ro'])}}"><img src="{{asset('images/flags/md.png')}}" alt="RO"></a>
    </div>
    </header>
    <div class="front-page-wrapper">
    	<div class="sidebar-menu">
	    	<ul class="sidebar-elements clearfix">
	    		<li><a href="{{ URL::to('about-us') }}" class="sidebar-menu-element">
                 <img src="{{ URL::asset('images/suitecase.png') }}" alt="suitcase"> {{trans('menu.about_us')}}
              </a>
          </li>
					<!--
<li><a href="#" class="sidebar-menu-element">
                <img src="{{ URL::asset('images/roopor.png') }}" alt="roopor">{{trans('menu.contact_us')}}
              </a>
          </li>
-->
					<li><a href="{{ URL::to('rules') }}" class="sidebar-menu-element">
                <img src="{{ URL::asset('images/info.png') }}" alt="info">{{trans('menu.rules')}}
              </a>
          </li>
					<li><a href="{{ URL::to('news') }}" class="sidebar-menu-element">
                <img src="{{ URL::asset('images/news.png') }}"alt="news"> {{trans('menu.news')}}
              </a>
          </li>
				</ul>
			</div>
    @yield('content')
    </div>
    <footer>
      <div class="container">
        <!--
<div class="row footer">
          <div class="columns">
            <div class="col-lg-6">
              <h3 class="title">Кратко о нас</h3>
              <div class="text" style="    font-family: sans-serif;    font-size: 13px;">
                Миссия глобальной платформы Jarvis-Tech   – капитальное (фундаментальное) реструктурирование индустрии ставок в интернет-пространстве,  посредством объединения инновационных вычислительных технологий и универсальных математических алгоритмов. Мы стремимся создать реальную альтернативу традиционным методам «аналитических предсказаний», что зачастую являются основной причиной разочарований, нестабильности и непрозрачности рынка спортивных ставок.  Мы даем людям  возможность определять качество наших методав В РЕАЛЬНОМ ВРЕМЕНИ, распространяем его по всему интернету. 
              </div>
            </div>
            <div class="col-lg-3">
              <h3 class="title">ИНФО</h3>
              <div class="text">
                <ul>
                  <li><a href="{{ URL::to('page/faq') }}">FAQ</a></li>
                  <li><a href="{{ URL::to('page/howdoipay') }}">Как проплачивать?</a></li>
                  <li><a href="{{ URL::to('page/bestinvestment') }}">Инвестиции</a></li>
                  <li><a href="{{ URL::to('page/info') }}">Another link info</a></li>
                  <li><a href="{{ URL::to('page/news') }}">Новости</a></li>
                  <li><a href="{{ URL::to('page/promotions') }}">Наши предложения</a></li>
                </ul>
              </div>
            </div>
            <div class="clmn">
              <div class="title">Свяжитесь с нами</div>
              <div class="text">
                е-майл: info@stoticlle.com<br>
                Кишинев, Молдова ул Московский проспект, 26/5
              </div>
            </div>
            <div class="col-lg-3">
              <h3 class="title">Присоединяйтесь!</h3>
              <div class="text">
                <div class="social">
                  <a href="#"><img src="{{ URL::asset('images/social/facebook.png') }}"></a>
                  <a href="#"><img src="{{ URL::asset('images/social/twitter.png') }}"></a>
                  <a href="#"><img src="{{ URL::asset('images/social/pinterest.png') }}"></a>
                  <a href="#"><img src="{{ URL::asset('images/social/googleplus.png') }}"></a>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
                <div class="copyright clearfix text-right">© Jarvis-Tech 2014. Все права зашишены.</div>
          </div>
        </div>
-->
				<div class="row">
					<div class="copyright">© Jarvis-Tech 2014. {{trans('layout.copyright')}}</div>
				</div>
      </div>
      
    </footer>
    
    @include('includes.frontend.scripts')
    @yield('custom_scripts')
<script type="text/javascript">
/*on html click, reveal initial block for header*/
      if ( window.matchMedia('(min-width: 992px)').matches || window.matchMedia('(max-width: 767px)').matches) {

      	$(document).click(function(e){
      		e.stopPropagation();
	      	if ( $(e.target).is("#login-register .text-right *") ) {	      		
		      	return;
	      	} else {
	      		$(".login-specific-button").hide();
						$(".register-specific-button").hide();
		      	$('.register-form').hide();  
						$('.login-form').show();
	      	}
      	});
			}
			$(window).resize(function() {
				var windowW = $(window).width();
				if ( windowW > 991 || windowW < 768 ) {
				
					$(".login-specific-button").hide();
					$(".register-specific-button").hide();
					
					$(document).click(function(e) {
      		e.stopPropagation();
	      	if ( $(e.target).is("#login-register .text-right *") ) {	      		
		      	return;
	      	} else {
	      		$(".login-specific-button").hide();
						$(".register-specific-button").hide();
		      	$('.register-form').hide();  
						$('.login-form').show();
	      	}
      	});
				}
			});
			if ( window.matchMedia('(min-width: 768px)').matches && window.matchMedia('(max-width: 991px)').matches ) {
				$(document).click(function(e){
      		e.stopPropagation();
	      	if ( $(e.target).is("#login-register .text-right *") ) {	      		
		      	return;
	      	} else {
						$(".register-form").removeClass("active");
						$(".login-form").removeClass("active");
						$(".login-specific-button").show();
						$(".register-specific-button").show();		
					}	
				});
			};
			$(window).resize(function() {
				var windowW = $(window).width();
				if ( windowW > 767 && windowW < 992 ) { 
					$(document).click(function(e){
      			e.stopPropagation();
						if ( $(e.target).is("#login-register .text-right *") ) {	      		
		      		return;
						} else {
							$(".register-form").removeClass("active");
							$(".login-form").removeClass("active");
							$(".login-specific-button").show();
							$(".register-specific-button").show();		
						}	
					});
				};
			});
      /*
$('div.register a').click(function(e) {
        e.stopPropagation();
        $('.register-form').show();
      });
*/
      $('.register-button').click(function(e) {
        e.stopPropagation();
        $('.register-form').show();
        $('.login-form').hide();
      });
      /*
$('.register-form').click(function(e) {
        e.stopPropagation();
      });
*/
      $(document).ready(function(){
      	$(".sidebar-menu-button").on("click",function() {
      		$(".user-slide-menu > i.fa-user").removeClass("active");
      		$("#login-register").removeClass("active");
      		$(".dashboard-user-slide-menu").removeAttr("style");
      		$(".dashboard-user-slide-menu").removeClass("active");
      		$(this).toggleClass("active");
	      	$(".sidebar-menu").toggleClass("active");	      	
				});
				
				if ( window.matchMedia('(min-width: 768px)').matches && window.matchMedia('(max-width: 991px)').matches ) {
					$(".login-specific-button").on("click", function(e){
						e.stopPropagation();
						$(this).hide();
						$(".register-specific-button").hide();
						setTimeout(function() {
							$("#login-register .login-form").addClass("active");
						}, 244); 
					});
					$(".register-specific-button").on("click", function(e){
						e.stopPropagation();
						$(this).hide();
						$(".login-specific-button").hide();
						setTimeout(function() {
							$("#login-register .register-form").addClass("active");
						}, 244); 
					})
				}
				$(window).resize(function() {
					var windowW = $(window).width();
					if ( windowW > 767 && windowW < 992 ) { 
						$(".login-specific-button").on("click", function(e){
						e.stopPropagation();
						$(this).hide();
						$(".register-specific-button").hide();
						setTimeout(function() {
							$("#login-register .login-form").addClass("active");
						}, 244); 
					});
					$(".register-specific-button").on("click", function(e){
						e.stopPropagation();
						$(this).hide();
						$(".login-specific-button").hide();
						setTimeout(function() {
							$("#login-register .register-form").addClass("active");
						}, 244); 
					})
					}
				});
			});

</script>
<script src="{{ asset('js/jquery.marquee.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/announcements-ticker.js') }}" type="text/javascript"></script>

  </body>
</html>
