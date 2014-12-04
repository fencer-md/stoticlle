@extends('layouts.frontend.base')

@section('content')
	<section class="map-region">
      <div class="container-fluid">
        <div class="map" id="world_map" style="background:url('{{ URL::asset('images/map.png') }}') no-repeat 0 0; background-size:900px auto">
          
        </div>
        <div class="info pull-right">
          <div class="inside">
            <div class="registered info-homepage"><div class="number">
              <div class="easy-pie-chart">
                <div class="number transactions" data-percent="{{ $totalInfo['allUsers'] * 100 / 100 }}">
                  <span>{{ $totalInfo['allUsers'] * 100 / 100 }} %</span>
                </div>
              </div>
            </div><div class="label">registered users</div></div>
            <div class="invested info-homepage"><div class="number">
              <div class="easy-pie-chart">
                <div class="number transactions" data-percent="{{ $totalInfo['allInvested'] * 100 / 100 }}">
                  <span>{{ $totalInfo['allInvested'] * 100 / 100 }} %</span>
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
              <div class="title">{{ $blocks[1]->content->title }}</div>
              <div class="text">
                {{ $blocks[1]->content->body }} <a href="{{ $blocks[1]->content->link }}">Read more</a>
              </div>
            </div>
            <div class="clmn">
              <div class="title">{{ $blocks[2]->content->title }}</div>
              <div class="text">
                {{ $blocks[2]->content->body }} <a href="{{ $blocks[1]->content->link }}">Read more</a>
              </div>
            </div>
            <div class="clmn">
              <div class="title">{{ $blocks[3]->content->title }}</div>
              <div class="text">
                {{ $blocks[3]->content->body }} <a href="{{ $blocks[1]->content->link }}">Read more</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="partners">
        <div class="container">
          <div class="row">
            <div class="title"><span>Partners</span></div>
            <div class="list">
              <div class="logo">
                <img src="data:image/png;base64,{{ $blocks[4]->content->partner_1 }}" />
              </div>
              <div class="logo">
                <img src="data:image/png;base64,{{ $blocks[4]->content->partner_2 }}" />
              </div>
              <div class="logo">
                <img src="data:image/png;base64,{{ $blocks[4]->content->partner_3 }}" />
              </div>
              <div class="logo">
                <img src="data:image/png;base64,{{ $blocks[4]->content->partner_4 }}" />
              </div>
              <div class="logo">
                <img src="data:image/png;base64,{{ $blocks[4]->content->partner_5 }}" />
              </div>
              <div class="logo">
                <img src="data:image/png;base64,{{ $blocks[4]->content->partner_6 }}" />
              </div>
            </div>
          </div>
        </div>
      </section>
      </div>
    </section>
@stop

@section('custom_scripts')
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