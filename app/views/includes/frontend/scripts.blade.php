<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('/js/raphael.js') }}"></script>
<script src="{{ URL::asset('/js/custom.js') }}"></script>
<script src="{{ URL::asset('backend/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('backend/scripts/metronic.js') }}" type="text/javascript"></script>       
<script src="{{ URL::asset('backend/layout/scripts/layout.js') }}" type="text/javascript"></script>
<script>
	jQuery(document).ready(function() {
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
	});
	
    $('.easy-pie-chart .number.transactions').easyPieChart({
        animate: 1000,
        size: 100,
        lineWidth: 4,
        barColor: Metronic.getBrandColor('red')
    });
</script>