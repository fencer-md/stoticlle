<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
	<head>
	   <meta charset="utf-8" />
	   <title>Dashboard</title>
	   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	   <meta content="" name="description" />
	   <meta content="" name="author" />
	   @include('includes.backend.styles')
	   <link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body class="page-header-fixed">
		<div class="page-header navbar navbar-fixed-top	">
		  <!-- BEGIN TOP NAVIGATION BAR -->
		  <div class="page-header-inner">
		  	@include('includes.backend.topnavigationbar')
		  </div>
		  <!-- END TOP NAVIGATION BAR -->
		</div>
		<div class="clearfix"></div>
		<div class="page-container">
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
	</body>
</html>