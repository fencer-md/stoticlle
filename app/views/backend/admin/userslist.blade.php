@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">User list</h3>
    <div class="row">
		<table class="table table-striped table-hover">
			<thead>
				<td>Email</td>
                @if ( Request::is('user/admin/nextstepusers') )
                    <td>Award</td>
                @endif
			</thead>
			<tbody>
			@foreach ( $users as $user )
				<tr>
					@if ( Request::is('user/admin/edituserlist') )
						<td><a href="{{ URL::to('user/admin/edituser/'.$user->id) }}">{{ $user->email }}</a></td>
					@else
						<td><a href="{{ URL::to('user/admin/transactions/'.$user->id) }}">{{ $user->email }}</a></td>
					@endif
                    @if ( Request::is('user/admin/nextstepusers') )
                        <td>
	                        <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/reward?uid='.$user->id) }}" data-target="#award-dialog"><i class="fa fa-edit"></i>Reward</a>
	                        <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/offer?uid='.$user->id) }}" data-target="#offer-dialog"><i class="fa fa-edit"></i>Offer</a>
                        </td>
                    @else
                        <td>-</td>
                    @endif
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
        <div class="modal fade" id="award-dialog" tabindex="-1" role="dialog" aria-labelledby="award" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            </div>
          </div>
        </div>
        <div class="modal fade" id="offer-dialog" tabindex="-1" role="dialog" aria-labelledby="offer" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            </div>
          </div>
        </div>
@stop