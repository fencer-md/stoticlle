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
		<section class="content-region content-about-us content-faq">
			<div class="container">
				<div class="row">
					<h1 class="page-title">О нас</h1>
					<div class="info-block">
						<div class="info-content">
							<p>Мы верим что объединив человеческий и «машинный» интеллекты, мы можем улучшить любую область нашей жизни. Не смотря на то, что современные технологии  затронули почти все сферы нашей жизни, индустрия спортивных ставок осталась на том же уровне чтои 20 лет назад. Пора это менять.
							</p>
						</div>
						<div class="text-center info-title">Для этого мы создали Jarvis.</div>
						<div class="question">Что такое JARVIS?</div>
						<video controls="controls" preload="preload" width="100%" style="margin-bottom:10px;">
							<source src="{{ asset('snd/promo_rus.mp4') }}" type="video/mp4">
							<source src="{{ asset('snd/promo_rus.webm') }}" type="video/webm">
							<source src="{{ asset('snd/promo_rus.ogg') }}" type="video/ogg">
						</video>
						
<!-- 						<img src="{{ URL::asset('images/global.jpg') }}" alt="global" class="img-responsive"> -->
						<div class="info-content">
							<p>Jarvis - это Алгорифмическая беттинговая машина. Cозданная на основе искусственного интеллекта, она обрабатывает огромное количество спортивных данных, с целью большой вероятности выигрыша.
							</p>
						</div>
						<div class="question">Как JARVIS работает?</div>
						<div class="info-content">
							<p>JARVIS выдаёт прогнозы с вероятностью выигрыша от 80% до 90%. Это достигается за счёт тысяч алгорифмов запрограммированных в JARVIS.Конечно же, главное преимущество JARVIS-а в исключении человеческого фактора, а именно:
							</p>
						</div>
					</div>
					<div class="step-by-step">
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">1</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>
								Подчиняется математическим расчётам 
								<div class="sub-text">В отличии от человека, он неподвластен эмоциям - страх, жадность, беспокойство.</div>
							</div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">2</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>
								Алгорифмы совершенствуются. 
								<div class="sub-text">Периодически программисты работают над улучшением алгорифмов.</div>
							</div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">3</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>
								Обрабатывает огромное количество данных.
								<div class="sub-text">Тут входят все данные: и те что были собраны с прошлых матчей, и данные которые JARVIS собирает в реальном времени.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
@stop

@section('custom_scripts')
<script src="{{ asset('backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
<link href="{{ asset('css/pictonic.css') }}" rel="stylesheet">

@stop