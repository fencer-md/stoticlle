<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{ URL::asset('backend/plugins/respond.min.js') }}"></script>
<script src="{{ URL::asset('backend/plugins/excanvas.min.js') }}"></script> 
<![endif]-->
<script src="{{ URL::asset('backend/plugins/jquery-1.11.0.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jquery-migrate-1.2.1.min.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{ URL::asset('backend/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') }}" type="text/javascript"></script>      
<script src="{{ URL::asset('backend/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>  
<script src="{{ URL::asset('backend/plugins/jquery.cokie.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript" ></script>
<script src="{{ URL::asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript" ></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ URL::asset('backend/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>   
<script src="{{ URL::asset('backend/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>  
<script src="{{ URL::asset('backend/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jquery.pulsate.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="{{ URL::asset('backend/plugins/fullcalendar/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script> 
<script src="{{ URL::asset('backend/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>   
<script src="{{ URL::asset('backend/plugins/gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ URL::asset('backend/scripts/metronic.js') }}" type="text/javascript"></script>       
<script src="{{ URL::asset('backend/layout/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/layout/scripts/quick-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/scripts/index.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/scripts/tasks.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->  
<script>
   jQuery(document).ready(function() {    
      Layout.init(); // init layout
      QuickSidebar.init() // init quick sidebar
      Index.init();   
      Index.initDashboardDaterange();
      Index.initJQVMAP(); // init index page's custom scripts
      Index.initCalendar(); // init index page's custom scripts
      Index.initCharts(); // init index page's custom scripts
      Index.initChat();
      Index.initMiniCharts();
      Index.initIntro();
      Tasks.initDashboardWidget();
   });
</script>
<!-- END JAVASCRIPTS -->