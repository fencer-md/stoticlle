@extends('layouts.frontend.base')

@section('content')
	@if(Session::has('msg'))
      <div class="col-md-12" id="successModal">
              <h3>Статус регестраций</h3>
            <div class="col-md-12 container">
              {{ Session::get('msg') }}
            </div>
      </div>
      @endif

        @if(Session::has('error'))
            <div class="col-md-12" id="errorModal">
                        <span class="error-icon"><i class="fa fa-thumbs-o-down"></i></span><span class="error-title">{{ Session::get('errorTitle') }}</span>
                        
                            {{ Session::get('error') }}
                        
                    </div>
        @endif
		<section class="map-region hidden-xs">
      <div class="container-fluid">
        <div class="map col-md-12 col-xs-12" id="world_map">
          
        </div>
        <!--
<div class="info pull-right col-md-3">
          <div class="inside">
            <div class="registered info-homepage">
            <div class="number"><i class="fa fa-users"></i><div class="block-header">
              <div class="lables"><div class="total-users">{{ $totalInfo['users_total']}}</div><div class="lable">Пользователей</div></div></div>
            </div>
            <div class="user-other"><div class="investors"><div class="investor-users" data-toggle="tooltip" data-placement="top" title="Инвестировали">{{ $totalInfo['users_invested']}}</div></div><div class="withdrawals"><div class="withdrawals" data-toggle="tooltip" data-placement="top" title="Вывели из системы">{{ $totalInfo['users_withdrew']}}</div></div></div>
            </div>
            <div class="invested info-homepage">
            <div class="number"><i class="fa fa-usd"></i><div class="block-header">
              <div class="lables"><div class="total-users"> ${{ $totalInfo['total_invested']+ $totalInfo['total_won']- $totalInfo['total_withdrew']}}</div><div class="lable">Всего в системе</div></div></div>
                  
            </div>
            <div class="user-other"><div class="investors"><div class="investor-users" data-toggle="tooltip" data-placement="top" title="Всего инвестировано">
                  $ {{ round($totalInfo['total_invested'])}}
                </div></div><div class="withdrawals"><div class="all-withdrawals" data-toggle="tooltip" data-placement="top" title="Всего выведено">
                  $ {{round ($totalInfo['total_withdrew'])}}
                </div></div></div>
            </div> 
          </div>
        </div>
-->
				<div class="announce col-xs-12 pull-left">@include('announcements.ticker')</div>
      </div>
      
    </section>
   
    <section class="content-region">
    	<section class="site-information col-xs-push-12">
    		<div class="container">
    			<div class="row">
						<div class="col-xs-12 col-sm-4 col-1">
							<div class="col">
								<img src="{{ URL::asset('images/people.png') }}" alt="people">
								<div class="text">
									<div class="number">35</div>
									<div class="info">Пользователей</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-middle">
							<div class="col">
								<img src="{{ URL::asset('images/persent.png') }}" alt="people">
								<div class="text">
									<div class="number">$188237</div>
									<div class="info">Всего в системе </div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-3">
							<div class="col">
								<img src="{{ URL::asset('images/airplane.png') }}" alt="people">
								<div class="text">
									<div class="number">823237</div>
									<div class="info">Анонсов в системе</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
      <section class="videos">
          <div class="container">
            <div class="row">
            	<div class="col-xs-12 col-sm-6">
            		<div class="text">
            			<h1>{{ $blocks[0]->content->title }}</h1>
									<div class="body">
            				{{ $blocks[0]->content->body }}
									</div>
								</div>
            	</div>
            	<div class="col-xs-12 col-sm-6">
            		<div class="video-list">
                	<div class="videos">
                		<div class="overlay"><img src="{{ URL::asset('images/player.png') }}" alt="player"></div>
										<iframe class="video_1 video" width="460" height="300" src="https://youtube.com/embed/sjI5y6rEJtw" frameborder="0" allowfullscreen></iframe>
										<iframe class="video_2 video" width="460" height="300" src="https://youtube.com/embed/{{ $blocks[0]->content->video_2 }}" frameborder="0" allowfullscreen></iframe>
										<iframe class="video_3 video" width="460" height="300" src="https://youtube.com/embed/{{ $blocks[0]->content->video_3 }}" frameborder="0" allowfullscreen></iframe>
									</div>
                
									<div class="thumbnails">
                  	<img class="video_1 video" src="https://img.youtube.com/vi/{{ $blocks[0]->content->video_1 }}/1.jpg">
										<img class="video_2 video" src="https://img.youtube.com/vi/{{ $blocks[0]->content->video_2 }}/1.jpg">
										<img class="video_3 video" src="https://img.youtube.com/vi/{{ $blocks[0]->content->video_3 }}/1.jpg">
									</div>
								</div>
            	</div>
            </div>
          </div>
				</section>
      <section class="columns">
        <div class="container">
          <div class="row">
            <div class="col col-xs-12 col-sm-6 col-md-4 about">
              <div class="col-md-12">
              	<div class="title">Jarvis Tech</div>
								<div class="text">
                	Вы сами будете контролировать процесс обогащения и в любой момент сможете изменить свое решение. Успех основан на уникальной стратегии в ставках, дающей прибыль в 50-400% в месяц(зависит от количества матчей)...
                </div>
                <div class="more-info"><a href="{{ $blocks[1]->content->link }}">» узнать больше</a></div>
             </div>
            </div>
            <div class="col col-xs-12 col-sm-6 col-md-4 how">
            <div class="col-md-12">
              <div class="title">Как это работает</div>
              <div class="text">
                Перед тем как нам начать чтото мы конечно хотели бы описать как мы работаем, и как наше с вами взаимодействие будет происходить, прошу вас ознакомиться с небольшой инструкцией...
              </div>
              <div class="more-info"><a href="{{ $blocks[1]->content->link }}">» инструкция</a></div>
            </div>
            </div>
            <div class="col col-xs-12 col-sm-12 col-md-4">
            <div class="col-md-12">
              <div class="title">Последние новости</div>
              <div class="text">
                  <div class="news"><span class="date">12.03.2014</span><a href="#" class="news-link">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></div>
                  <div class="news"><span class="date">12.03.2014</span><a href="#" class="news-link">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></div>
                  <div class="news"><span class="date">12.03.2014</span><a href="#" class="news-link">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </section>
      <section class="partners">
        <div class="container">
          <div class="row">
            <div class="title"><span>Методы оплаты</span></div>
            <div class="list">
              <div class="logo">
                <img src="{{ asset('backend/img/pay_met/skrill.png') }}" alt="Skrill" />
              </div>
              <div class="logo">
                  <img src="{{ asset('backend/img/pay_met/webmoney.png') }}" alt="WebMoney" />
              </div>
              <div class="logo">
                  <img src="{{ asset('backend/img/pay_met/payza.png') }}" alt="Payza" />
              </div>
              <div class="logo">
                  <img src="{{ asset('backend/img/pay_met/payeer.png') }}" alt="Payeer" />
              </div>
              <div class="logo">
                  <img src="{{ asset('backend/img/pay_met/perfect_money.png') }}" alt="Perfect Money" />
              </div>
              <div class="logo">
                  <img src="{{ asset('backend/img/pay_met/okpay.png') }}" alt="OKPAY" />
              </div>
              <!--
<div class="logo">
                <img src="../../public/backend/img/pay_met/rR9Pw.jpg" alt="rR9Pw" width="" height="" />
              </div>
              <div class="logo">
                <img src="../../public/backend/img/pay_met/yandex.money_.jpg" alt="yandex.money_" width="" height="" />
              </div>
-->
              
          	</div>
					</div>
        </div>
      </section>
    </section>
@stop

@section('custom_scripts')
<script src="{{ asset('backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
<link href="{{ asset('css/pictonic.css') }}" rel="stylesheet">

<script>
  var my_data = {{ $usersData }};
  $('[data-toggle="tooltip"]').tooltip();
  $('img.video').click(function() {
    var firstClass = $(this).attr('class').split(' ');
    firstClass = firstClass[0];
    $('iframe.video').hide();
    $('iframe.'+firstClass).show();
  });
  $(".video-list .overlay").on("click",function() {
	  $(this).next(".video #player").click();
	  $(this).fadeOut();
  });
  /* front page ".site-information" arragement*/	
	$(window).resize(function() {
		var deviceWidth = $(window).width();
		if ( deviceWidth < 768 ) {
			$('section.videos').after( $('.site-information') );
		} else {
			$('section.videos').before( $('.site-information') );
		}
	});
</script>
@stop