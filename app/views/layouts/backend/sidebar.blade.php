<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
    @if ( Auth::user()->role == "1" )
	@endif
    @if ( Auth::user()->role == "2" )
	@endif
</ul>