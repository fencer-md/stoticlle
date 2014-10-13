<div class="profile">
	<div class="name">Hello {{ Auth::user()->userInfo->first_name }}</div>
	@if ( Auth::user()->role == '2' )
		<div class="avlb-amount">Available amount: {{ $data }}$</div>
	@endif
</div>