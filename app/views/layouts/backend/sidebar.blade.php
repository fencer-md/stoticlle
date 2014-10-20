<ul class="page-sidebar-menu">
	<li class="name">Hello {{ Auth::user()->userInfo->first_name }}</li>
    @if ( Auth::user()->role == "1" )
	@endif
    @if ( Auth::user()->role == "2" )
		<li class="avlb-amount">Available amount: {{ $data }}$</li>
	@endif
</ul>