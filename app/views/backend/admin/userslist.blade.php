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
					<td><a href="{{ URL::to('user/admin/transactions/'.$user->id) }}">{{ $user->email }}</a></td>
				</tr>
		@endforeach
			</tbody>
		</table>
	</div>
@stop