@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">User list</h3>
    <div class="row">
		<table class="table table-striped table-hover">
			<thead>
				<td>UID</td>
                <td>Email</td>
                <td>Last login</td>
                <td>Ammount added</td>
                <td>Current available</td>
                <td>Times invested</td>
                @if ( Request::is('user/admin/nextstepusers') )
                    <td>Ammount invested</td>
                    <td>Awards recieved</td>
                    <td>Award</td>
                @elseif ( Request::is('user/admin/awarded') )
                    <td>Ammount invested</td>
                    <td>Awards recieved</td>
                @endif
			</thead>
			<tbody>
			@foreach ( $users as $user )
				<tr>
                    <td>{{ $user['user']->id }}</td>
					@if ( Request::is('user/admin/edituserlist') )
						<td><a href="{{ URL::to('user/admin/edituser/'.$user['user']->id) }}">{{ $user['user']->email }}</a></td>
					@else
						<td><a href="{{ URL::to('user/admin/transactions/'.$user['user']->id) }}">{{ $user['user']->email }}</a></td>
					@endif
                    <td>Last login</td>
                    <td>{{ $user['ammountAdded'] }}$</td>
                    <td>{{ $user['currentAmmount'] }}$</td>
                    <td>{{ $user['investedTimes'] }}</td>
                    @if ( Request::is('user/admin/awarded') || Request::is('user/admin/nextstepusers') )
                        <td>{{ $user['investedAmmount'] }}</td>
                        <td>{{ $user['awardedAmmount'] }}</td>
                    @endif
                    @if ( Request::is('user/admin/nextstepusers') )
                        <td>
                            <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/reward?uid='.$user['user']->id) }}" data-target="#award-dialog"><i class="fa fa-edit"></i>Reward</a>
                            <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/offer?uid='.$user['user']->id) }}" data-target="#offer-dialog"><i class="fa fa-edit"></i>Offer</a>
                        </td>
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