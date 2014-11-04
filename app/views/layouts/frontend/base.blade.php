<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stoticlle</title>

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
            <div class="col-md-10">
              @if ( Auth::user() == null )
                <div class="login-form">              
                  {{ Form::open(['action' => 'SessionsController@store', 'class' => 'login-form']) }}
                      {{ Form::text('email', null, ['placeholder' => 'E-mail']) }}
                      {{ Form::password('password', null, ['placeholder' => 'Password']) }}
                      {{ Form::submit('Login') }}
                  {{ Form::close() }}
                </div>
                <div class="register">
                  Don't have an account? <a href="#">Register</a>
                  <div class="register-form">
                    {{ Form::open(['route' => 'user.store', 'class' => 'form-signin']) }}
                        {{ Form::text('email', null, ['placeholder' => 'E-mail']) }}
                        {{ Form::submit('Submit') }}
                    {{ Form::close() }}
                  </div>
                </div>
              @else
                <div class="logout">
                  <a href="{{ URL::to('logout') }}">Logout</a>
                </div>
              @endif
            </div>
            <div class="col-md-2">
              <select class="language-picker">
                <option>English</option>
                <option>Romanian</option>
                <option>Russian</option>
              </select>
            </div>
        </div>
      </div>
    </header>
    @yield('content')
    <footer>
      <div class="container">
        <div class="row footer">
          <div class="columns">
            <div class="clmn">
              <div class="title">Short about us info</div>
              <div class="text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut nulla vitae dolor sollicitudin accumsan. Morbi ex ex, ornare nec elit a, varius convallis metus. Suspendisse potenti. 
              </div>
            </div>
            <div class="clmn">
              <div class="title">Some links</div>
              <div class="text">
                <ul>
                  <li><a href="#">FAQ</a></li>
                  <li><a href="#">How do i pay?</a></li>
                  <li><a href="#">This is the best investment</a></li>
                  <li><a href="#">Another link info</a></li>
                  <li><a href="#">News</a></li>
                  <li><a href="#">Promotions</a></li>
                </ul>
              </div>
            </div>
            <div class="clmn">
              <div class="title">Contact us</div>
              <div class="text">
                e-mail: info@stoticlle.com<br>
                Chisinau, Republic of Moldova
                Investitiilor street, 26/5
              </div>
            </div>
            <div class="clmn">
              <div class="title">Follow us on</div>
              <div class="text">
                <div class="social">
                  <a href="#"><img src="{{ URL::asset('images/social/facebook.png') }}"></a>
                  <a href="#"><img src="{{ URL::asset('images/social/twitter.png') }}"></a>
                  <a href="#"><img src="{{ URL::asset('images/social/pinterest.png') }}"></a>
                  <a href="#"><img src="{{ URL::asset('images/social/googleplus.png') }}"></a>
                </div>
                <div class="copyright">© stoticlle 2014. All rights reserved.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    @include('includes.frontend.scripts')
    <script type="text/javascript">
      var usersData = {{ $usersData }}
      $('html').click(function() {
        $('.register-form').hide();        
      });
      $('body > header > div > div > div.col-md-10 > div.register > a').click(function(e) {
        e.stopPropagation();
        $('.register-form').show();
      });
      $('.register-form').click(function(e) {
        e.stopPropagation();
      });
    </script>
  </body>
</html>