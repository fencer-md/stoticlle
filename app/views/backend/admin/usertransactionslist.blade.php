@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title"><b>{{ $data['user']['email'] }}</b> transaction history</h3>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <td>Transaction ID</td>
                <td>Date</td>
                <td>Transaction type</td>
                <td>Payment method</td>
                <td>Direction</td>
                <td>Ammount</td>
                @if ( Request::is('user/admin/investments/*') )
                    <td>Reward</td>
                @endif
            </thead>
            <tbody>
        @foreach ( $data['transactions'] as $transaction )
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->transaction_type }}</td>
                    <td>@if ( $transaction->payment_method == NULL )
                            System
                        @else
                            {{ $transaction->payment_method }}
                        @endif
                    </td>
                    <td>{{ $transaction->transaction_direction }}</td>
                    <td>{{ $transaction->ammount }}</td>
                    @if ( Request::is('user/admin/investments/*') )
                        @if ( $transaction->transaction_direction == 'invested' )
                            <td><a class="btn default btn-xs purple" data-toggle="modal" href="{{ URL::to('user/admin/reward?uid='.$transaction->user_id.'&tid='.$transaction->id) }}" data-target="#modal"><i class="fa fa-edit"></i>Reward</a></td>
                        @else
                            <td>-</td>
                        @endif
                    @endif
                </tr>
        @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            </div>
          </div>
        </div>
@stop