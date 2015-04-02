<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        .wrapper {
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            border-radius: 12px;
            border: 1px solid #DDDDDD;
            padding: 15px;
        }
        .button {
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border-radius: 6px;
            background-color: #1D5381;
            color: #ffffff;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="wrapper">
    {{trans('emails.salutation', array(
        'dear' => trans_choice('emails.dear', $genderNumber),
        'name' => $name,
        ))}}
    <img src="{{ asset('images/logo.png') }}" alt="Jarvis tech" width="155" height="30" align="right">
    @yield('content')
</div>
</body>
</html>
