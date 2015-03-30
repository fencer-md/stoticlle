<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
	<head>
	   <meta charset="utf-8" />
	   <title>Dashboard</title>
	   <meta name="csrf-token" content="<?= csrf_token() ?>">
	   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	   <meta content="" name="description" />
	   <meta content="" name="author" />
	   @include('includes.backend.styles')
	   <link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body class="page-header-fixed">
		<div class="page-header navbar navbar-fixed-top clearfix">
            {{-- BEGIN TOP NAVIGATION BAR --}}
            <div class="page-header-inner clearfix">
                <div class="pull-left page-logo col-xs-12 col-sm-4 col-md-3">
                	<div class="pull-left dashboard dashboard-sidebar-menu-button">
										<span></span>
										<span></span>
										<span></span>
									</div>
                    <a href="/" class="logo-text"><img src="{{ URL::asset('images/logo.png') }}"></a>
                </div>
                <div class="blurry hidden-xs col-sm-push-4 col-md-push-3"></div>
                <div class="col-xs-8 col-sm-8 col-md-6">@include('announcements.ticker')</div>
                <div class="pull-right">
                    @include('layouts.backend.topnavigationbar')
                </div>
            </div>
            {{-- END TOP NAVIGATION BAR --}}
		</div>
		<div class="clearfix"></div>
		<div class="page-container">
			<div class="sidebar-menu-top">
	    	<ul class="sidebar-elements clearfix">
	    		<li><a href="#" class="sidebar-menu-element"><img src="{{ URL::asset('images/suitecase.png') }}" alt="suitcase">{{trans('menu.about_us')}}</a></li>
<!-- 					<li><a href="#" class="sidebar-menu-element"><img src="{{ URL::asset('images/roopor.png') }}" alt="roopor">{{trans('menu.contact_us')}}</a></li> -->
					<li><a href="#" class="sidebar-menu-element"><img src="{{ URL::asset('images/info.png') }}" alt="info">{{trans('menu.rules')}}</a></li>
					<li><a href="#" class="sidebar-menu-element"><img src="{{ URL::asset('images/news.png') }}"alt="news">{{trans('menu.news')}}</a></li>
				</ul>
			</div>
			<!-- BEGIN SIDEBAR -->
			<div class="page-sidebar-wrapper">
				<div class="page-sidebar navbar-collapse collapse">
					@include('layouts.backend.sidebar')
				</div>
			</div>
			<!-- END SIDEBAR -->
			<!-- BEGIN PAGE -->
			<div class="page-content-wrapper">
			  <!-- BEGIN PAGE CONTAINER-->
			  <div class="page-content">
				  @include('flash::message')
			    <!-- BEGIN PAGE HEADER-->
			    @yield('content')
			    <!-- END PAGE HEADER-->
			    <!-- CONTENT BODY GOES HERE >>>> -->
			  </div>   
			  <!-- END PAGE CONTAINER-->
			</div>      
			<!-- END PAGE -->
		</div>
		<!-- BEGIN FOOTER -->
		<div class="footer">
		   <div class="footer-inner">
		   </div>
		   <div class="footer-tools">
		   </div>
		</div>
		<!-- END FOOTER -->
		@include('includes.backend.scripts')
		@yield('custom_scripts')
		<script src="{{ asset('js/jquery.marquee.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/announcements-ticker.js') }}" type="text/javascript"></script>
	</body>
</html>