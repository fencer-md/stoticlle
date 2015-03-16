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
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sodales quam nisi, et imperdiet nisi volutpat non. Nullam quis ante aliquet ex gravida vestibulum condimentum at augue.</p>
						<p>Nullam quam tellus, vulputate id metus quis, pellentesque eleifend quam. Quisque egestas nisl ex, a tincidunt ipsum sodales ut. Nullam aliquam eros quis vulputate dapibus. In non felis imperdiet massa iaculis laoreet nec quis nisl. Pellentesque quam ex, finibus eget suscipit eu, molestie eget lorem. </p>
					</div>
					<div class="step-by-step">
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">1</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. </div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">2</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. </div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">3</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. </div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">4</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. </div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">5</div>
							</div>
							<div class="step-content"><div class="step-arrow"></div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. </div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">6</div>
							</div>
							<div class="step-content "><div class="step-arrow"></div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. </div>
						</div>
						<div class="step clearfix">
							<div class="number">	
								<div class="step-number">7</div>
							</div>
							<div class="step-content">
								<div class="step-arrow"></div><div class="step-media"></div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti.
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