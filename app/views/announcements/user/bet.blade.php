@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Announcements</h3>
    <div class="row">
        {{ Form::open(['action' => null, 'class' => 'form', 'role' => 'form']) }}
        <div class="form-body">
            <div class="form-group">
                {{ Form::label('message', Lang::get('userpage.message')) }}
                <div class="input-group">
                    {{ $data->message }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('bet',  Lang::get('userpage.bet')) }}
                <div class="input-group">
                    {{ Form::text('bet') }}
                </div>
            </div>
            {{ Form::submit(Lang::get('common.save'), ['class' => 'btn btn-lg blue']) }}
        </div>
        {{ Form::close() }}
    </div>
@stop
