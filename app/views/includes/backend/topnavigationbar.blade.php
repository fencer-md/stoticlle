<div class="profile">
	<div class="name">Hello {{ Auth::user()->email }}</div>
	<div class="avlb-amount">Available amount: {{ $data }}$</div>
</div>