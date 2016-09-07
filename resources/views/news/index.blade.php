@extends('layouts.app')

@section('content')

	<div class="container">
		<h1>News</h1>
		

		<ul>
			
		@foreach ($list as $news)
			<li>
				<a href="/news/{{$news->id}}">{{ $news->title }}</a> <br>- Published by {{$news->publisher()->first()->name}}
			</li>
		@endforeach
		</ul>
	</div>

@endsection