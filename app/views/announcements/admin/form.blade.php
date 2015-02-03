@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Announcements</h3>
    <div class="row">
        {{ Form::open(['action' => null, 'class' => 'form', 'role' => 'form']) }}
        <div class="form-body">
            <div class="form-group">
                {{ Form::label('announcement_type', 'Announcement type') }}
                <div class="input-group">
                    {{ Form::select('announcement_type', array(1=>1, 2=>2, 3=>3), $data->announcement_type, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('message', 'Message') }}
                <div class="input-group">
                    {{ Form::textarea('message', $data->message, ['class' => 'form-control', 'rows' => 3, 'cols' => 20]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('coefficient', 'Coefficient') }}
                <div class="input-group">
                    {{ Form::text('coefficient', $data->coefficient, ['class' => 'form-control']) }}
                </div>
            </div>

            {{ Form::submit('Create', ['class' => 'btn btn-lg blue']) }}
        </div>
        {{ Form::close() }}
    </div>
@stop
