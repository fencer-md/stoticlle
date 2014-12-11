@extends('layouts.frontend.base')

@section('content')
	<section class="map-region">
      <div class="container-fluid">
        <div class="map" id="world_map" style="background:url('{{ URL::asset('images/map.png') }}') no-repeat 0 0; background-size:910px 450px">
          
        </div>
        <div class="info pull-right">
          <div class="inside">
            <div class="registered info-homepage"><div class="number"><i class="fa fa-users"></i>
              {{ $totalInfo['allUsers'] * 100 / 100 }}
            </div><div class="label">users</div></div>
            <div class="invested info-homepage"><div class="number">
              <div class="easy-pie-chart">
                <div class="number transactions" data-percent="{{ $totalInfo['allInvested'] * 100 / 100 }}">
                  <span>{{ $totalInfo['allInvested'] * 100 / 100 }} $</span>
                </div>
              </div>
            </div><div class="label">invested by users</div></div>
          </div>
        </div>
      </div>
    </section>
    <section class="content-region">
      <section class="videos">
          <div class="container">
            <div class="row">
            	<div class="text">
            		<h1>{{ $blocks[0]->content->title }}</h3>
            		<div class="body">
            			{{ $blocks[0]->content->body }}
            		</div>
            	</div>
            	<div class="video-list">
                <div class="videos">
            		  <iframe class="video_1 video" width="460" height="300" src="//www.youtube.com/embed/{{ $blocks[0]->content->video_1 }}" frameborder="0" allowfullscreen></iframe>
                  <iframe class="video_2 video" width="460" height="300" src="//www.youtube.com/embed/{{ $blocks[0]->content->video_2 }}" frameborder="0" allowfullscreen></iframe>
                  <iframe class="video_3 video" width="460" height="300" src="//www.youtube.com/embed/{{ $blocks[0]->content->video_3 }}" frameborder="0" allowfullscreen></iframe>
            	  </div>
                <div class="thumbnails">
                  <img class="video_1 video" src="http://img.youtube.com/vi/{{ $blocks[0]->content->video_1 }}/1.jpg">
                  <img class="video_2 video" src="http://img.youtube.com/vi/{{ $blocks[0]->content->video_2 }}/1.jpg">
                  <img class="video_3 video" src="http://img.youtube.com/vi/{{ $blocks[0]->content->video_3 }}/1.jpg">
                </div>
              </div>
            </div>
          </div>
      </section>
      <section class="columns">
        <div class="container">
          <div class="row">
            <div class="clmn">
              <div class="title">Jarvis Tech</div>
              <div class="text">
                Вы сами будете контролировать процесс обогащения и в любой момент сможете изменить свое решение. Успех основан на уникальной стратегии в ставках, дающей прибыль в 50-400% в месяц(зависит от количества матчей).                <a href="{{ $blocks[1]->content->link }}"> детали</a>
              </div>
            </div>
            <div class="clmn">
              <div class="title">Как это работает</div>
              <div class="text">
                Перед тем как нам начать чтото мы конечно хотели бы описать как мы работаем, и как наше с вами взаимодействие будет происходить, прошу вас ознакомиться с небольшой инструкцией <a href="{{ $blocks[1]->content->link }}">инструкция</a>
              </div>
            </div>
            <div class="clmn">
              <div class="title">Последние новости</div>
              <div class="text">
                  <a href="">детали</a>
              </div>
            </div>
            <!--
<div class="clmn">
              <div class="title">{{ $blocks[3]->content->title }}</div>
              <div class="text">
                {{ $blocks[3]->content->body }} <a href="{{ $blocks[1]->content->link }}">Read more</a>
              </div>
            </div>
-->
          </div>
        </div>
      </section>
      <section class="partners">
        <div class="container">
          <div class="row">
            <div class="title"><span>Методы оплаты</span></div>
            <div class="list">
              <div class="logo">
                <img src="../../public/backend/img/pay_met/imgres-1.png" alt="imgres-1" width="" height="" />
              </div>
              <div class="logo">
                <img src="../../public/backend/img/pay_met/imgres.png" alt="imgres" width="" height="" />
              </div>
              <div class="logo">
                <img src="../../public/backend/img/pay_met/logo-footer.png" alt="logo-footer" width="" height="" />
              </div>
              <div class="logo">
                <img src="../../public/backend/img/pay_met/logo.png" alt="logo" width="" height="" />
              </div>
              <div class="logo">
                <img src="../../public/backend/img/pay_met/logo3.png" alt="logo3" width="" height="" />
              </div>
              <div class="logo">
                <img src="../../public/backend/img/pay_met/okpay-logo-226x142-orange.png" alt="okpay-logo-226x142-orange" width="" height="" />
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
      </section>
      </div>
    </section>
@stop

@section('custom_scripts')
<script src="../../public/backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<link href="../../public/backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="{{ asset('css/pictonic.css') }}" rel="stylesheet">

<script>
  var my_data = {{ $usersData }};

  $('img.video').click(function() {
    var firstClass = $(this).attr('class').split(' ');
    firstClass = firstClass[0];
    $('iframe.video').hide();
    $('iframe.'+firstClass).show();
  });
</script>

@stop