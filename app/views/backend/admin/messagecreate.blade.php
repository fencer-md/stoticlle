@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title">Messaging</h3>
    <div class="row">        
        {{ Form::open(['action' => 'MessageController@create', 'class' => 'form', 'role' => 'form']) }}
            <div class="form-body">
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    <div class="input-group">
                        {{ Form::text('title', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('recipient', 'Recipient') }}
                    <div class="input-group">
                        {{ Form::text('recipient', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                {{--<div class="form-group">
                    <div class="input-group">
                        {{ Form::checkbox('mass', 1, false) }}
                        {{ Form::label('mass', 'Mass message') }}
                    </div>
                </div>--}}
                <div class="form-group">
                    {{ Form::label('body', 'Body') }}
                    <div class="input-group">
                        {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                {{ Form::submit('Create', ['class' => 'btn btn-lg blue']) }}
            </div>
        {{ Form::close() }}
	</div>
@stop