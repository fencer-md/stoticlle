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
  <body>
    <header>
      <div class="container">
        <div class="row top-header">
        <div class="col-md-2"><a href="#" class="logo-text">JARVIS TECH</a></div>
            <div class="col-md-10 text-right">
            
              @if ( Auth::user() == null )
                <div class="login-form">              
                  {{ Form::open(['action' => 'SessionsController@store', 'class' => 'login-form']) }}
                      {{ Form::text('email', null, ['placeholder' => 'E-mail']) }}
                      {{ Form::password('password', null, ['placeholder' => 'Password']) }}
                      {{ Form::submit('войти') }}
                  {{ Form::close() }}
                </div>
                <div class="register">
                  вы еще не снами? <a href="#">Присоединяйтесь</a>
                  <div class="register-form">
                    {{ Form::open(['action' => 'UserController@store', 'class' => 'form-signin']) }}
                        {{ Form::text('email', null, ['placeholder' => 'E-mail']) }}
                        {{ Form::submit('Submit') }}
                    {{ Form::close() }}
                  </div>
                </div>
              @else
                <div class="control-panel">
                  <a href="{{ URL::to('user/transactions') }}" class="btn btn-xs default red-stripe"><i class="fa fa-keyboard-o"></i> Панель управления</a>
                </div>
                <div class="logout">
                  <a href="{{ URL::to('logout') }}" class="btn btn-xs default red-stripe"><i class="fa fa-sign-out"></i> Выйти</a>
                </div>
              @endif
            </div>
            <!--
<div class="col-md-2">
              <select class="language-picker">
                <option>Руский</option>
                <option>English</option>
                <option>Romina</option>
              </select>
            </div>
-->
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
      @if(Session::has('msg'))
      <div class="modal fade" id="successModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h3>Статус регестраций</h3>
            </div>
            <div class="modal-body">
              <p>{{ Session::get('msg') }}</p>
            </div>
          </div>
        </div>
      </div>
      @endif
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
      $(window).load(function(){
          $('#successModal').modal('show');
      });
    </script>
  </body>
</html>
