@extends('layouts.app')

@section('content')
<div class="container">
    <div class="herounit">
        <h2>Mail has been sent to your email address ({{ $model->email }}).</h2>
        <p>Click <a href="/auth/resend?name={{urlencode($model->username)}}&email={{urlencode($model->email)}}">here</a> if you don't get an email.</p>
    </div>
</div>
@endsection
