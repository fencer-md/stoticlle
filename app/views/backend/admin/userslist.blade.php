@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">User list</h3>
    <div class="row">
		<table class="table table-striped table-hover">
			<thead>
				<td>
                    @if ($sortby == 'users.id' && $order == 'desc')
                        {{ HTML::linkAction('UserController@'.$controller, 'UID', ['sortby' => 'users.id', 'order' => 'asc']) }}
                    @else
                        {{ HTML::linkAction('UserController@'.$controller, 'UID', ['sortby' => 'users.id', 'order' => 'desc']) }}
                    @endif
                </td>
                <td>
                    @if ($sortby == 'users.email' && $order == 'asc')
                        {{ HTML::linkAction('UserController@'.$controller, 'Email', ['sortby' => 'users.email', 'order' => 'desc', 'table' => 'users']) }}
                    @else
                        {{ HTML::linkAction('UserController@'.$controller, 'Email', ['sortby' => 'users.email', 'order' => 'asc', 'table' => 'users']) }}
                    @endif
                </td>
                <td>
                    @if ($sortby == 'user_money_info.ammount_added' && $order == 'asc')
                        {{ HTML::linkAction('UserController@'.$controller, 'Ammount added', ['sortby' => 'user_money_info.ammount_added', 'order' => 'desc']) }}
                    @else
                        {{ HTML::linkAction('UserController@'.$controller, 'Ammount added', ['sortby' => 'user_money_info.ammount_added', 'order' => 'asc']) }}
                    @endif
                </td>
                <td>
                    @if ($sortby == 'user_money_info.current_available' && $order == 'asc')
                        {{ HTML::linkAction('UserController@'.$controller, 'Current available', ['sortby' => 'user_money_info.current_available', 'order' => 'desc']) }}
                    @else
                        {{ HTML::linkAction('UserController@'.$controller, 'Current available', ['sortby' => 'user_money_info.current_available', 'order' => 'asc']) }}
                    @endif
                </td>
                <td>
                    @if ($sortby == 'user_money_info.times_invested' && $order == 'asc')
                        {{ HTML::linkAction('UserController@'.$controller, 'Times invested', ['sortby' => 'user_money_info.times_invested', 'order' => 'desc']) }}
                    @else
                        {{ HTML::linkAction('UserController@'.$controller, 'Times invested', ['sortby' => 'user_money_info.times_invested', 'order' => 'asc']) }}
                    @endif
                </td>
                @if ( Request::is('user/admin/nextstepusers') )
                    <td>
                        @if ($sortby == 'user_money_info.ammount_invested' && $order == 'asc')
                            {{ HTML::linkAction('UserController@'.$controller, 'Ammount invested', ['sortby' => 'user_money_info.ammount_invested', 'order' => 'desc']) }}
                        @else
                            {{ HTML::linkAction('UserController@'.$controller, 'Ammount invested', ['sortby' => 'user_money_info.ammount_invested', 'order' => 'asc']) }}
                        @endif
                    </td>
                    <td>
                        @if ($sortby == 'user_money_info.ammount_won' && $order == 'asc')
                            {{ HTML::linkAction('UserController@'.$controller, 'Awarded', ['sortby' => 'user_money_info.ammount_won', 'order' => 'desc']) }}
                        @else
                            {{ HTML::linkAction('UserController@'.$controller, 'Awarded', ['sortby' => 'user_money_info.ammount_won', 'order' => 'asc']) }}
                        @endif
                    </td>
                @elseif ( Request::is('user/admin/awarded') )
                    <td>
                        @if ($sortby == 'user_money_info.ammount_invested' && $order == 'asc')
                            {{ HTML::linkAction('UserController@'.$controller, 'Ammount invested', ['sortby' => 'user_money_info.ammount_invested', 'order' => 'desc']) }}
                        @else
                            {{ HTML::linkAction('UserController@'.$controller, 'Ammount invested', ['sortby' => 'user_money_info.ammount_invested', 'order' => 'asc']) }}
                        @endif
                    </td>
                    <td>
                        @if ($sortby == 'user_money_info.times_won' && $order == 'asc')
                            {{ HTML::linkAction('UserController@'.$controller, 'Awards recieved', ['sortby' => 'user_money_info.times_won', 'order' => 'desc']) }}
                        @else
                            {{ HTML::linkAction('UserController@'.$controller, 'Awards recieved', ['sortby' => 'user_money_info.times_won', 'order' => 'asc']) }}
                        @endif
                    </td>
                        @if ($sortby == 'user_money_info.ammount_won' && $order == 'asc')
                            {{ HTML::linkAction('UserController@'.$controller, 'Ammount awarded', ['sortby' => 'user_money_info.ammount_won', 'order' => 'desc']) }}
                        @else
                            {{ HTML::linkAction('UserController@'.$controller, 'Ammount awarded', ['sortby' => 'user_money_info.ammount_won', 'order' => 'asc']) }}
                        @endif
                    </td>
                @endif
                <td>
                    @if ($sortby == 'users.last_login' && $order == 'asc')
                        {{ HTML::linkAction('UserController@'.$controller, 'Last login', ['sortby' => 'users.last_login', 'order' => 'desc']) }}
                    @else
                        {{ HTML::linkAction('UserController@'.$controller, 'Last login', ['sortby' => 'users.last_login', 'order' => 'asc']) }}
                    @endif
                </td>
			</thead>
			<tbody>
            @if ( $users != null )
    			@foreach ( $users as $user )
    				<tr>
                        <td>{{ $user->id }}</td>
    					@if ( Request::is('user/admin/edituserlist') )
    						<td><a href="{{ URL::to('user/admin/edituser/'.$user->id) }}">{{ $user->email }}</a></td>
    					@else
    						<td><a href="{{ URL::to('user/admin/transactions/'.$user->id) }}">{{ $user->email }}</a></td>
    					@endif
                        <td>{{ $user->ammount_added }}$</td>
                        <td>{{ ( $user->ammount_added + $user->ammount_won ) - ( $user->ammount_invested + $user->ammount_withdrawn ) }}$</td>
                        <td>{{ $user->times_invested }}</td>
                        @if ( Request::is('user/admin/awarded') )
                            <td>{{ $user->ammount_invested }}$</td>
                            <td>{{ $user->times_won }}</td>
                            <td>{{ $user->ammount_won }}$</td>
                        @endif
                        @if ( Request::is('user/admin/nextstepusers') )
                            <td>{{ $user->ammount_invested }}$</td>
                            <td>{{ $user->ammount_won }}$</td>
                        @endif
                        <td>{{ $user->last_login }}</td>
                        @if ( Request::is('user/admin/nextstepusers') )
                            <td>
                                <a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/offer?uid='.$user->id) }}" data-target="#offer-dialog"><i class="fa fa-edit"></i>Offer</a>
                            </td>
                        @endif
    				</tr>
    			@endforeach
            @endif
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