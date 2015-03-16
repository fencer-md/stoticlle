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
		<section class="content-region content-news">
			<div class="container">
				<div class="row">
					<h1 class="page-title">Новости</h1>
						<div class="news clearfix">
							<div  class="news-date">13.03.2015</div>
							<div class="news-info col-md-9">
								<div class="news-title">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. Suspendisse quis pulvinar mi.
								</div>
								<div class="news-info">					  
									Aliquam in turpis cursus justo varius fringilla in venenatis ipsum. Donec quis mauris justo. Vestibulum eleifend pulvinar erat sed euismod. Vivamus hendrerit tortor et lacus dignissim viverra.Nulla varius, quam nec tristique viverra, quam velit tempor erat, id venenatis lorem elit euismod purus.
								</div>
							</div>
							<div class="news-image col-md-3">
								<div class="news-media"></div>
							</div>
						</div>
						<div class="news clearfix">
							<div  class="news-date">13.03.2015</div>
							<div class="news-info col-md-9">
								<div class="news-title">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. Suspendisse quis pulvinar mi.
								</div>
								<div class="news-info">					  
									Aliquam in turpis cursus justo varius fringilla in venenatis ipsum. Donec quis mauris justo. Vestibulum eleifend pulvinar erat sed euismod. Vivamus hendrerit tortor et lacus dignissim viverra.Nulla varius, quam nec tristique viverra, quam velit tempor erat, id venenatis lorem elit euismod purus.
								</div>
							</div>
							<div class="news-image col-md-3">
								<div class="news-media"></div>
							</div>
						</div>
						<div class="news clearfix">
							<div  class="news-date">13.03.2015</div>
							<div class="news-info col-md-9">
								<div class="news-title">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. Suspendisse quis pulvinar mi.
								</div>
								<div class="news-info">					  
									Aliquam in turpis cursus justo varius fringilla in venenatis ipsum. Donec quis mauris justo. Vestibulum eleifend pulvinar erat sed euismod. Vivamus hendrerit tortor et lacus dignissim viverra.Nulla varius, quam nec tristique viverra, quam velit tempor erat, id venenatis lorem elit euismod purus.
								</div>
							</div>
							<div class="news-image col-md-3">
								<div class="news-media"></div>
							</div>
						</div>
						<div class="news clearfix">
							<div  class="news-date">13.03.2015</div>
							<div class="news-info col-md-9">
								<div class="news-title">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. Suspendisse quis pulvinar mi.
								</div>
								<div class="news-info">					  
									Aliquam in turpis cursus justo varius fringilla in venenatis ipsum. Donec quis mauris justo. Vestibulum eleifend pulvinar erat sed euismod. Vivamus hendrerit tortor et lacus dignissim viverra.Nulla varius, quam nec tristique viverra, quam velit tempor erat, id venenatis lorem elit euismod purus.
								</div>
							</div>
							<div class="news-image col-md-3">
								<div class="news-media"></div>
							</div>
						</div>
						<div class="news clearfix">
							<div  class="news-date">13.03.2015</div>
							<div class="news-info col-md-9">
								<div class="news-title">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consectetur eget nisi sit amet suscipit. Suspendisse potenti. Suspendisse quis pulvinar mi.
								</div>
								<div class="news-info">					  
									Aliquam in turpis cursus justo varius fringilla in venenatis ipsum. Donec quis mauris justo. Vestibulum eleifend pulvinar erat sed euismod. Vivamus hendrerit tortor et lacus dignissim viverra.Nulla varius, quam nec tristique viverra, quam velit tempor erat, id venenatis lorem elit euismod purus.
								</div>
							</div>
							<div class="news-image col-md-3">
								<div class="news-media"></div>
							</div>
						</div>
						<nav class="news-pagination">
							<ul class="pagination">
								<li>
									<a href="#" aria-label="Previous">
										<span aria-hidden="true">&laquo;</span>
									</a>
								</li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li>
									<a href="#" aria-label="Next">
										<span aria-hidden="true">&raquo;</span>
									</a>
								</li>
							</ul>
						</nav>
				</div>
			</div>
		</section>
@stop

@section('custom_scripts')
<script src="{{ asset('backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js') }}" type="text/javascript"></script>
<link  href="{{ asset('backend/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
<link  href="{{ asset('css/pictonic.css') }}" rel="stylesheet">

@stop