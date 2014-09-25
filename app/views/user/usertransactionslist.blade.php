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
                <td>Transaction ID</td>
                <td>Date</td>
                <td>Direction</td>
                <td>Ammount</td>
            </thead>
            <tbody>
        @foreach ( $data['transactions'] as $transaction )
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->date }}</td>
                    <td>{{ $transaction->transaction_direction }}</td>
                    <td>{{ $transaction->ammount }}</td>
                </tr>
        @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop