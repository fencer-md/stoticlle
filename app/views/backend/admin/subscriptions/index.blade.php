@extends('layouts.backend.base')

@section('content')
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Stream</th>
            <th>Start</th>
            <th>Expires</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->email}}</td>
                <td>@if($user->announcement_stream) {{$user->announcements->name}} @endif</td>
                <td>@if($user->announcement_start) {{$user->announcement_start->format('d.m.Y')}} @endif</td>
                <td>@if($user->announcement_expires) {{$user->announcement_expires->format('d.m.Y')}} @endif</td>
                <td>@if($user->announcement_stream) <a href="{{ URL::to('admin/subscriptions/extend', ['uid' => $user->id, 'period' => $period]) }}">Extend</a> @endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script type="text/javascript">
	    jQuery('body > div.page-container > div.page-content-wrapper > div > table > tbody > tr:nth-child(64) > td:nth-child(5)').text('25.04.2015');
	    jQuery('body > div.page-container > div.page-content-wrapper > div > table > tbody > tr:nth-child(46) > td:nth-child(5)').text('25.04.2015');
    </script>
@stop
