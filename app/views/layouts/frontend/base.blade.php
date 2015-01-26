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
    <header>
      <div class="container">
      	<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
        <div class="row top-header">
        <div class="col-md-2"><a href="/" class="logo-text"><img src="{{ URL::asset('images/logo.png') }}"></a></div>
            
            <!--
<div class="col-md-2">
              <select class="language-picker">
                <option>Руский</option>
                <option>English</option>
                <option>Romina</option>
              </select>
            </div>
-->
        
        <div class="login">
        @if ( Auth::user() == null )
	      <div id="show-login"><i class="fa fa-user"></i></div>
		  <div id="login-register">
			  <div class="text-right">
            
              
                <div class="login-form">              
                  {{ Form::open(['action' => 'SessionsController@store', 'class' => 'login-form']) }}
                      <div class="input-icon"><i class="fa fa-user"></i>{{ Form::text('email', null, ['placeholder' => 'E-mail', 'class'=>'form-control']) }}</div>
                      <div class="input-icon"><i class="fa fa-lock"></i>{{ Form::password('password', ['placeholder' => 'Пароль','class'=>'form-control']) }}</div>
                      <div class="form-actions">{{ Form::submit('войти', ['class'=>'btn blue']) }}</div>
                  {{ Form::close() }}
                </div>
                <div class="register">
                  <div class="login-msg" >вы еще не снами? <a id="join" href="#">Присоединяйтесь</a></div>
                  <div class="register-form">
                    {{ Form::open(['action' => 'UserController@store', 'class' => 'form-signin']) }}
                        <div class="input-icon"><i class="fa fa-user"></i>{{ Form::text('email', null, ['placeholder' => 'E-mail','class'=>'form-control']) }}</div>
                        <div class="form-actions">{{ Form::submit('присоединиться', ['class'=>'btn blue']) }}</div>
                    {{ Form::close() }}
                  </div>
                </div>
              
            </div>
            @else
                <!-- BEGIN USER LOGIN DROPDOWN -->
				<div class="dropdown dropdown-user">
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
				</div>
				<!-- END USER LOGIN DROPDOWN -->
              @endif
		  </div>
      </div>
        </div>
      </div>
      
    </header>
    
    @yield('content')
    <footer>
      <div class="container">
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
            <!--
<div class="clmn">
              <div class="title">Свяжитесь с нами</div>
              <div class="text">
                е-майл: info@stoticlle.com<br>
                Кишинев, Молдова ул Московский проспект, 26/5
              </div>
            </div>
-->
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
      </div>
      
    </footer>
    @include('includes.frontend.scripts')
    @yield('custom_scripts')
    <script type="text/javascript">
      $('html').click(function() {
        $('.register-form').hide();        
      });
      $('div.register a').click(function(e) {
        e.stopPropagation();
        $('.register-form').show();
      });
      $('.register-form').click(function(e) {
        e.stopPropagation();
      });
    </script>
  </body>
</html>
