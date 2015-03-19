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
      <div class="blurry"></div>  
    </div>
    <div class="announce pull-left">@include('announcements.ticker')</div>
    <div class="user-slide-menu pull-right">
    	<div class="menu-toggler sidebar-toggler hide">
			<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
<!--     	<div class="row top-header"> -->
        <!-- <div class="col-md-2"><a href="/" class="logo-text"><img src="{{ URL::asset('images/logo.png') }}"></a></div> -->
        <!-- <div class="col-md-6">@include('announcements.ticker')</div> -->
        <!-- <div class="col-md-2"><select class="language-picker"><option>Руский</option><option>English</option><option>Romina</option></select></div>-->
        @if ( Auth::user() == null )
        <div class="login clearfix">
					<div id="login-register">
						<div class="text-right">
               <div class="login-form">              
                 {{ Form::open(['action' => 'SessionsController@store', 'class' => 'login-form']) }}
                     <div class="input-icon"><i class="fa fa-user"></i>{{ Form::text('email', null, ['placeholder' => 'E-mail', 'class'=>'form-control']) }}</div>
                     <div class="input-icon"><i class="fa fa-lock"></i>{{ Form::password('password', ['placeholder' => 'Пароль','class'=>'form-control']) }}</div>
                     <div class="form-actions">{{ Form::submit('Войти', ['class'=>'btn blue']) }}</div>
                     
                 {{ Form::close() }}
                 <div class="form-actions register-button">{{ Form::submit('Присоединяйтесь', ['id'=>'join'])}}</div>
               </div>
               <div class="register">
                 <!-- <div class="login-msg" >вы еще не снами? <a id="join" href="#">Присоединяйтесь</a></div> -->
                 <div class="register-form">
                   {{ Form::open(['action' => 'UserController@store', 'class' => 'form-signin']) }}
                       <div class="input-icon"><i class="fa fa-user"></i>{{ Form::text('email', null, ['placeholder' => 'E-mail','class'=>'form-control']) }}</div>
                       <div class="form-actions">{{ Form::submit('присоединиться', ['class'=>'btn blue']) }}</div>
                   {{ Form::close() }}
               </div>
            </div>
					</div>
        </div>
        @else
        <div class="dashboard-user-sliding-menu pull-right">
					<div class="username username-hide-on-mobile pull-left">
						Hello <strong >{{ Auth::user()->userInfo->first_name }} {{ Auth::user()->userInfo->last_name }}</strong> 
					</div>
					<a href="{{ URL::to('logout') }}" class="icon"><i class="fa fa-sign-out"></i></a>
					<div class="dashboard-user-slide-menu"> 
						<ul class="menu clearfix">
							<li class="user-menu-element"><a href="{{ URL::to('user/edit') }}"><span class="menu-title">Личный кабинет</span></a></li>
							<li class="user-menu-element"><a href="{{ URL::to('user/transactions') }}"><span class="menu-title">Транзакций</span></a></li>
							<li class="user-menu-element"><a href="{{ URL::to('user/addmoney') }}"><span class="menu-title">Пополнение средств</span></a></li>
							<li class="user-menu-element"><a href="{{ URL::to('user/withdraw') }}"><span class="menu-title">Вывод средств</span></a></li>
							<li class="user-menu-element"><a href="{{ URL::to('bet') }}"><span class="menu-title">Ставки</span></a></li>
						</ul>
					</div>
				</div>
				@endif
    </div>
    </header>
    <div class="front-page-wrapper">
    	<div class="sidebar-menu">
	    	<ul class="sidebar-elements clearfix">
	    		<li><a href="#" class="sidebar-menu-element"><img src="{{ URL::asset('images/suitecase.png') }}" alt="suitcase">О проекте</a></li>
					<li><a href="#" class="sidebar-menu-element"><img src="{{ URL::asset('images/roopor.png') }}" alt="roopor">Связь с нами</a></li>
					<li><a href="#" class="sidebar-menu-element"><img src="{{ URL::asset('images/info.png') }}" alt="info">Правила поьзования</a></li>
					<li><a href="#" class="sidebar-menu-element"><img src="{{ URL::asset('images/news.png') }}"alt="news">Новости</a></li>
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
					<div class="copyright">© Jarvis-Tech 2014. Все права зашишены.</div>
				</div>
      </div>
      
    </footer>
    
    @include('includes.frontend.scripts')
    @yield('custom_scripts')
    <script type="text/javascript">
      $('html').click(function() {
         $('.register-form').hide();  
         $('.login-form').show();       
      });
      $('div.register a').click(function(e) {
        e.stopPropagation();
        $('.register-form').show();
      });
      $('.register-button').click(function(e) {
        e.stopPropagation();
        $('.register-form').show();
      });
      $('.register-form').click(function(e) {
        e.stopPropagation();
      });
      $(document).ready(function(){
      	$(".sidebar-menu-button").on("click",function() {
      		$(this).toggleClass("active");
	      	$(".sidebar-menu").toggleClass("active");
				});
				
			});

    </script>
    <script src="{{ asset('js/jquery.marquee.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/announcements-ticker.js') }}" type="text/javascript"></script>

  </body>
</html>
