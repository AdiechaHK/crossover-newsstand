@extends('layouts.app')

@section('content')

	<div class="container">
		
		@section('title', 'New Entry')
		@include('news/form')

	</div>

@endsection