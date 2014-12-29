@extends('layouts.frontend.base')

@section('content')
  <section class="pages-content">
    <div class="container">
      <div class="row">
        <h3 class="page-title">Password reminder</h3>

        <div class="page-body">
          <form action="{{ action('RemindersController@postRemind') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="email" name="email">
            <input type="submit" value="Send Reminder">
          </form>
        </div>
      </div>
    </div>
  </section>
@stop