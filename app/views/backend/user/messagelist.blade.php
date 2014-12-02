@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Messaging</h3>
    <div class="row">
        @if ( Auth::user()->role == '1' )
            <a href="{{ URL::to('user/messages/create') }}" class="btn btn-lg red">Write a message <i class="fa fa-edit"></i></a>
        @endif
        <table class="table table-striped table-hover">
            <thead>
                <td>Title</td>
                <td>Recipient</td>
                <td>Date created</td>
            </thead>
            <tbody>
            @foreach ( $data as $message )
                <tr>
                    <td>{{ $message->title }}</td>
                    <td>{{ $message->user }}</td>
                    <td>{{ $message->created_at }}</td>
                </tr>
            @endforeach                
            </tbody>
        </table>
	</div>
@stop