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
<!--
		<section class="content-region">    
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
              <!--<div class="logo"><img src="../../public/backend/img/pay_met/rR9Pw.jpg" alt="rR9Pw" width="" height="" /></div><div class="logo"><img src="../../public/backend/img/pay_met/yandex.money_.jpg" alt="yandex.money_" width="" height="" /></div>/*here should be closing comentary*/
            </div>
          </div>
        </div>
      </section>
    </section>
-->
		<section class="content-region content-faq">
			<div class="container">
				<div class="row">
					<h1 class="page-title">Как это работает</h1>
					<div class="additional-info">
						<p>Для того чтобы ты имел успех в Джарвисе и преумножил свой капитал - есть определенные правила, которые нужно соблюдать.</p>
						<p>Если ты не будешь соблюдать эти правила - нет никакого смысла работать с джарвисом.</p>
					</div>
					<div class="step-by-step">
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">1</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div> Каждый день с 9:30 войди в свой аккаунт, для начала ставок.</div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">2</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>В колонке "Сумма на счёте" - укажи ту сумму, которую ты готов вложить в ставки. </div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">3</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>Каждый раз, когда тебе JARVIS рекоммендует ставить определенную сумму денег, например $15, мы советуем делать именно такую ставку. JARVIS не только даёт прогнозы на выигрыш, но и определенную последовательность ставок, для того чтобы ты остался в плюсе.</div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">4</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>Если ты получил минус - дождись первого плюса. Если ты получили даже два минуса, дождитесь результата. Если после двух минусов, то есть двух поражений будет плюс, поток закроется и ты будешь в выигрыше. Если будет минус, в этой игре ты проиграешь. Вероятность получить три минуса подряд - редкий случай. Смысл в том, чтобы не оставлять на минусе игру, а посмотреть чем закончится поток.</div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">5</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>Не пропускай игры. Чем больше ты пропускаешь игр, тем больше ты теряешь возможностей.</div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">6</div>
							</div>
							<div class="step-content "><div class="step-arrow"></div>Если букмерская  до завершения игры предлагает забрать ставку, но в замен она предлагает хорошую прибыль, мы советуем забрать ставку. Например в теннисе - если будет счет 30:0 и контора предлагает хорошую прибыль - забираете деньги.</div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">7</div>
							</div>
							<div class="step-content">
								<div class="step-arrow"></div><!-- <div class="step-media"></div> -->Количество игр за один день - неизвестно. Каждый день будут минимум две игры.
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