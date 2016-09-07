@extends('layouts.app')

@section('content')

	<div class="container">
		
		<h1>{{$news->title}}</h1>

		<img src="{{url($news->image)}}" alt="{{ $news->title }}">

		<p>
			{{$news->text}}
		</p>

		<a href="/news">Back to news list</a>

	</div>


@endsection