@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Поток</h3>
    <div class="row">
        {{ Form::open(['action' => null, 'class' => 'form', 'role' => 'form']) }}
        <div class="form-body">
            <div class="form-group">
                {{ Form::label('name', 'Название потока') }}
                <div class="input-group">
                    {{ Form::text('name', $data->name, ['class' => 'form-control']) }}
                </div>
            </div>

            {{ Form::submit('Сохранить', ['class' => 'btn btn-lg blue']) }}
        </div>
        {{ Form::close() }}
    </div>
@stop
