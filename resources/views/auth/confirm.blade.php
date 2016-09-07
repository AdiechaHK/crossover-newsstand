@extends('layouts.app')

@section('content')
<div class="container">
	<div class="herounit box text-center">
		<h2 class="text-success">Mail has been sent to your email address ({{ $model->email }}).</h2>
		<h4>Click <a href="/auth/resend?name={{urlencode($model->username)}}&email={{urlencode($model->email)}}">here</a> if you don't get an email.</h4>
	</div>
</div>
@endsection
