@extends('user.base')

@section('content')
<div class="wrapper">
    <div class="menu">
        <a href="{{ URL::to('user/edit') }}">Edit profile</a>
        <a href="{{ URL::to('user/transactions') }}">User transactions</a>
        <a href="{{ URL::to('user/admin/transactions') }}">Admin transactions</a>
        <a href="{{ URL::to('logout') }}">Logout</a>
    </div>
    <div class="content">
		<table>
			<thead>
				<td>Email</td>
			</thead>
			<tbody>
		@foreach ( $users as $user )
				<tr>
					<td><a href="{{ URL::to('user/admin/transactions/'.$user->id) }}">{{ $user->email }}</a></td>
				</tr>
		@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop