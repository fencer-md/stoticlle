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
					<h1 class="page-title">Jarvis Tech</h1>
					<div class="info-block">
						<div class="about-image">
							<div class="media"></div>
						</div>
						<h1 class="info-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. Suspendisse quis pulvinar mi.</h1>
						<div class="info-content">
							<p>orem ipsum dolor sit amet, consectetur adipiscing elit. Sed odio orci, auctor sit amet justo sed, pretium pulvinar ex. Proin varius leo at viverra molestie. Nam eu erat eu neque efficitur gravida non vehicula odio. Proin bibendum enim id massa tempus, semper vestibulum nunc posuere. Donec sed faucibus nibh. Vivamus sapien purus, sagittis tincidunt ultrices vel, maximus vitae tortor. Donec tristique mauris ut metus vehicula accumsan. Praesent vel ex velit. Curabitur quis felis convallis, interdum tellus et, finibus nisl. Donec nulla eros, sagittis sit amet dolor sed, tincidunt viverra augue. Morbi ut neque euismod libero congue congue ac eu ipsum.</p>

							<p>Aliquam quis arcu a magna rutrum viverra eu a dolor. In ultrices odio sapien, dictum efficitur ipsum varius et. Vivamus eleifend felis erat, tincidunt volutpat mi cursus pharetra. Sed gravida nibh vitae ultrices dignissim. Proin placerat arcu ut egestas cursus. In hac habitasse platea dictumst. Vivamus tempus urna orci, eu efficitur purus porta ac.</p>

							<p>Nunc eget nisl eleifend, ullamcorper arcu eu, luctus purus. Nullam feugiat felis ac mi mattis, non accumsan nisl tristique. Duis consequat porttitor enim, sit amet interdum ipsum tempor nec. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed sed molestie tellus. Aenean diam velit, pretium ac enim nec, euismod convallis dui. Ut congue leo enim, quis euismod ligula commodo eu. Sed fringilla hendrerit magna, ut consequat erat venenatis eget. Quisque eget metus ut diam elementum eleifend. Mauris sit amet odio mi.</p>

							<p>Fusce tristique accumsan mauris ut ullamcorper. Maecenas sit amet nibh eros. Fusce ut dignissim ligula. Vivamus consectetur dapibus massa, vel tincidunt mauris tristique eu. Cras in mollis nisl, a molestie nisl. Integer magna libero, efficitur ac risus at, fringilla porta urna. Nulla aliquet, risus quis dignissim convallis, nulla lacus commodo eros, eu faucibus mi magna a risus. Vestibulum maximus sollicitudin massa, ut semper tellus volutpat accumsan. Nunc turpis est, pellentesque quis dictum at, fringilla sed orci. Aliquam convallis nulla et euismod molestie. Mauris in velit lacus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</div>
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
							<div class="step-content"><div class="step-arrow"></div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. </div>
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