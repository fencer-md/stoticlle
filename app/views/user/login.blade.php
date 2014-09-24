{{ Form::open(['action' => 'SessionsController@store', 'class' => '']) }}
    {{ Form::text('email', null, ['placeholder' => 'E-mail']) }}
    {{ Form::password('password', null, ['placeholder' => 'Password']) }}
    {{ Form::submit('Login') }}
{{ Form::close() }}