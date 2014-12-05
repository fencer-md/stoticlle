@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title"><b>{{ $page->title }}</b> edit</h3>
    <div class="row">
        {{ Form::open(['action' => 'ContentController@update', 'class' => 'form', 'role' => 'form']) }}
            {{ Form::hidden('pid', $page->id) }}
            <div class="form-body">
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    <div class="input-group">
                        {{ Form::text('title', $page->title, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('body', 'Body') }}
                    <div class="input-group">
                        <textarea name="body" id="summernote">{{ $page->body }}</textarea>
                    </div>
                </div>
                {{ Form::submit('Submit', ['class' => 'btn btn-lg blue']) }}
            </div>
        {{ Form::close() }}
    </div>
@stop

@section('custom_scripts')

    <link href="{{ URL::asset('backend/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <script src="{{ URL::asset('backend/plugins/bootstrap-summernote/summernote.min.js') }}" media="screen"/></script>

    <script>
        $('#summernote').summernote({height: 300});
    </script>

@stop