<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Registration confirmation</h2>

		<div>
			Click the following link to confirm your registration
			<a href="{{ URL::to('/') }}/user/confirm/{{ $code }}">{{ URL::to('/') }}/user/confirm/{{ $code }}</a>
			<br> Password: {{ $password }}
		</div>
	</body>
</html>