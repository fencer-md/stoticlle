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
<script src="{{ URL::asset('backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/plugins/selectize/js/selectize.min.js') }}" type="text/javascript"></script>
<link href="{{ URL::asset('backend/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript" media="screen"/>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ URL::asset('backend/scripts/metronic.js') }}" type="text/javascript"></script>       
<script src="{{ URL::asset('backend/layout/scripts/layout.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/layout/scripts/quick-sidebar.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/scripts/tasks.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/scripts/components-picker.js') }}" type="text/javascript"></script>
<link href="{{ URL::asset('backend/scripts/components-editor.js') }}" type="text/javascript" media="screen"/>
<!-- END PAGE LEVEL SCRIPTS -->  
<script>
	jQuery(document).ready(function() {
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init(); // init quick sidebar
		ComponentsPickers.init();
	});
	jQuery.validator.setDefaults({
	});

	jQuery("#invest-sidebar-form").validate({
		rules: {
			ammount: {
				required: 'true',
				number: 'true'
			}
		}
	});
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
	    }
	});

@if ( Auth::user()->role == 2 )
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }

	function showPosition(position) {
        $.ajax({
            type: 'post',
            url: '/user/edit/coords?lat='+position.coords.latitude+'&long='+position.coords.longitude,
            beforeSend: function(request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
        });
	}
@endif
</script>
<!-- END JAVASCRIPTS -->
<!-- END JAVASCRIPTS -->