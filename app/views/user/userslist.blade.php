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