@extends('layouts.frontend.base')

@section('content')
	<section class="map-region">
      <div class="container-fluid">
        <div class="map">
          <img src="{{ URL::asset('images/map.png') }}">
        </div>
        <div class="info">
          <div class="inside">
            <div class="registered"><div class="number">8569</div><div class="label">registered users</div></div>
            <div class="invested"><div class="number">$2500</div><div class="label">invested by users</div></div>
          </div>
        </div>
      </div>
    </section>
    <section class="content-region">
      <section class="videos">
          <div class="container">
            <div class="row">
            	<div class="text">
            		<h1>Our business is the best deal for you!</h3>
            		<div class="body">
            			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut nulla vitae dolor sollicitudin accumsan. Morbi ex ex, ornare nec elit a, varius convallis metus. Suspendisse potenti.
            		</div>
            	</div>
            	<div class="video-list">
            		<iframe width="460" height="300" src="//www.youtube.com/embed/qLJ3fERSS1Q" frameborder="0" allowfullscreen></iframe>
            	</div>
            </div>
          </div>
      </section>
      <section class="columns">
        <div class="container">
          <div class="row">
            <div class="clmn">
              <div class="title">Title</div>
              <div class="text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut nulla vitae dolor sollicitudin accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#">Read more</a>
              </div>
            </div>
            <div class="clmn">
              <div class="title">Title</div>
              <div class="text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut nulla vitae dolor sollicitudin accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#">Read more</a>
              </div>
            </div>
            <div class="clmn">
              <div class="title">Title</div>
              <div class="text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ut nulla vitae dolor sollicitudin accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#">Read more</a>
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
                <a href="#"><img src="{{ URL::asset('images/partner.png') }}"></a>
              </div>
              <div class="logo">
                <a href="#"><img src="{{ URL::asset('images/partner.png') }}"></a>
              </div>
              <div class="logo">
                <a href="#"><img src="{{ URL::asset('images/partner.png') }}"></a>
              </div>
              <div class="logo">
                <a href="#"><img src="{{ URL::asset('images/partner.png') }}"></a>
              </div>
              <div class="logo">
                <a href="#"><img src="{{ URL::asset('images/partner.png') }}"></a>
              </div>
              <div class="logo">
                <a href="#"><img src="{{ URL::asset('images/partner.png') }}"></a>
              </div>
            </div>
          </div>
        </div>
      </section>
      </div>
    </section>
@stop