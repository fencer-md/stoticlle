@extends('layouts.backend.base')

@section('content')
    <h3 class="page-title"><b>Block edit</b> edit</h3>
    <div class="row">
        @if ( $block->title == 'main-block' )
            {{ Form::open(['action' => 'ContentController@updateMainBlock', 'class' => 'form', 'role' => 'form']) }}
                {{ Form::hidden('pid', $block->id) }}
                <div class="form-body">
                    <div class="form-group">
                        {{ Form::label('body', 'Body') }}
                        <div class="input-group">
                            {{ Form::textarea('body', $block->content->body, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('video_1', 'Video link 1') }}
                        <div class="input-group">
                            {{ Form::text('video_1', $block->content->video_1, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('video_2', 'Video link 2') }}
                        <div class="input-group">
                            {{ Form::text('video_2', $block->content->video_2, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('video_3', 'Video link 3') }}
                        <div class="input-group">
                            {{ Form::text('video_3', $block->content->video_3, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    {{ Form::submit('Save', ['class' => 'btn btn-lg blue']) }}
                </div>
            {{ Form::close() }}
        @elseif ( $block->title == 'block-1' || $block->title == 'block-2' || $block->title == 'block-3' )
            {{ Form::open(['action' => 'ContentController@updateBlocks', 'class' => 'form', 'role' => 'form']) }}
                {{ Form::hidden('pid', $block->id) }}
                <div class="form-body">
                    <div class="form-group">
                        {{ Form::label('body', 'Body') }}
                        <div class="input-group">
                            {{ Form::textarea('body', $block->content->body, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('link', 'Link') }}
                        <div class="input-group">
                            {{ Form::text('body', $block->content->link, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    {{ Form::submit('Save', ['class' => 'btn btn-lg blue']) }}
                </div>
            {{ Form::close() }}
        @elseif ( $block->title == 'partners' )
            {{ Form::open(['action' => 'ContentController@updatePartners', 'class' => 'form', 'role' => 'form', 'files' => true]) }}
                {{ Form::hidden('pid', $block->id) }}
                <div class="form-body">
                    <div class="form-group">
                        {{ Form::label('partner_1', 'Partner 1') }}
                        <div class="input-group">
                            <img src="data:image/png;base64,{{ $block->content->partner_1 }}">
                            {{ Form::file('partner_1', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('partner_2', 'Partner 2') }}
                        <div class="input-group">
                            <img src="data:image/png;base64,{{ $block->content->partner_2 }}">
                            {{ Form::file('partner_2', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('partner_3', 'Partner 3') }}
                        <div class="input-group">
                            <img src="data:image/png;base64,{{ $block->content->partner_3 }}">
                            {{ Form::file('partner_3', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('partner_4', 'Partner 4') }}
                        <div class="input-group">
                            <img src="data:image/png;base64,{{ $block->content->partner_4 }}">
                            {{ Form::file('partner_4', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('partner_5', 'Partner 5') }}
                        <div class="input-group">
                            <img src="data:image/png;base64,{{ $block->content->partner_5 }}">
                            {{ Form::file('partner_5', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('partner_6', 'Partner 6') }}
                        <div class="input-group">
                            <img src="data:image/png;base64,{{ $block->content->partner_6 }}">
                            {{ Form::file('partner_6', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    {{ Form::submit('Save', ['class' => 'btn btn-lg blue']) }}
                </div>
            {{ Form::close() }}
        @endif
    </div>
@stop