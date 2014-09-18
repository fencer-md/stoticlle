{{ Form::open(['route' => 'user.store', 'class' => 'form-signin']) }}
    {{ Form::text('email', null, ['placeholder' => 'E-mail']) }}
    {{ Form::submit('Submit') }}
{{ Form::close() }}