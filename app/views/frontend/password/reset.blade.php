@extends('layouts.frontend.base')

@section('content')
  <section class="pages-content">
    <div class="container">
      <div class="row">
        <h3 class="page-title">Password reminder</h3>

        <div class="page-body">
          <form action="{{ action('RemindersController@postReset') }}" method="POST">
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            Email: <input type="email" name="email"><br />
            Password: <input type="password" name="password"><br />
            Confirm: <input type="password" name="password_confirmation"><br />
            <input type="submit" value="Reset Password">
          </form>

        </div>
      </div>
    </div>
  </section>
@stop