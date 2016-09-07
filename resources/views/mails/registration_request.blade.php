<!DOCTYPE html>
<html>
<head>
	<title>Confirmation email</title>
</head>
<body>
	<h1>Hello {{ $model->username }} !</h1>
	<p>You have been requested for registration with '{{ $model->email }}' email account.</p>
	<p>Clicke <a href="{{url('/register/' . $model->hash)}}">here</a> to confirm your account</p>
</body>
</html>