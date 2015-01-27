@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Announcements</h3>
    <a href="{{ URL::to('announcements/create') }}">Add</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Тип</th>
            <th>Текст</th>
            <th>Коэффициент</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($announcements as $a)
            <tr>
                <td>{{ $a->announcement_type }}</td>
                <td>{{ $a->message }}</td>
                <td>{{ $a->coefficient }}</td>
                <td>Edit / Delete</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
