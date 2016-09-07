@extends('layouts.app')

@section('content')

	<div class="container">
		
		<a href="/news/create">Add news</a>
		<h1>News</h1>
		

		<ul>
			
		@foreach ($list as $news)
			<li>
				<a href="/news/{{$news->id}}">{{ $news->title }}</a> ({{$news->publisher()->first()->name}})
			</li>
		@endforeach
		</ul>
	</div>

@endsection