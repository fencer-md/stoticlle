@extends('layouts.frontend.base')

@section('content')
	<section class="map-region">
      <div class="container-fluid">
        <div class="map">
          <img src="{{ URL::asset('images/map.png') }}">
        </div>
        <div class="info">
          <div class="inside">
            <div class="registered"><div class="number">{{ $totalInfo['allUsers'] }}</div><div class="label">registered users</div></div>
            <div class="invested"><div class="number">${{ $totalInfo['allInvested'] }}</div><div class="label">invested by users</div></div>
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
            		<iframe width="460" height="300" src="//www.youtube.com/embed/{{ $blocks[0]->content->video_1 }}" frameborder="0" allowfullscreen></iframe>
            	  <img src="http://img.youtube.com/vi/{{ $blocks[0]->content->video_1 }}/1.jpg">
                <img src="http://img.youtube.com/vi/{{ $blocks[0]->content->video_2 }}/1.jpg">
                <img src="http://img.youtube.com/vi/{{ $blocks[0]->content->video_3 }}/1.jpg">
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
  var usersData = {{ $usersData }};
</script>
@stop