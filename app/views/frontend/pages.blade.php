@extends('layouts.frontend.base')

@section('content')
  <section class="pages-content">
    <div class="container">
      <div class="row">
        <h3 class="page-title">{{ $page->title }}</h3>
        <div class="page-body">
          {{ $page->body }}
        </div>
      </div>
    </div>
  </section>
@stop