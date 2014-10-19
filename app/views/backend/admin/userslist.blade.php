@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">User list</h3>
    <div class="row">
		<table class="table table-striped table-hover">
			<thead>
				<td>Email</td>
			</thead>
			<tbody>
			@foreach ( $users as $user )
				<tr>
					@if ( Request::is('user/admin/edituserlist') )
						<td><a href="{{ URL::to('user/admin/edituser/'.$user->id) }}">{{ $user->email }}</a></td>
					@else
						<td><a href="{{ URL::to('user/admin/transactions/'.$user->id) }}">{{ $user->email }}</a></td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
@stop