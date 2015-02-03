@extends('layouts.backend.base')

@section('content')
    {{ Form::open(['action' => null, 'class' => 'form', 'role' => 'form']) }}
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Тип</th>
            <th>Текст</th>
            <th>Коэффициент</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $a)
            <tr>
                <td>{{ Form::checkbox('success['.$a->id.']', 1, $a->success, ['class' => 'form-control']) }}</td>
                <td>{{ $a->announcement_type }}</td>
                <td>{{ $a->message }}</td>
                <td>{{ $a->coefficient }}</td>
                <td>@if ($a->expires_at->isPast()) Public @endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ Form::submit('Save', ['class' => 'btn btn-lg blue']) }}
    {{ Form::close() }}
@stop
