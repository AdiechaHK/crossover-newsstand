@extends('layouts.app')

@section('content')

	<div class="container">
		<h3><span class="co-underline">News</span></h3>
		<div class="clearfix"></div><br />

		<div class="row">
			<div class="col-md-12">
				@foreach ($list as $news)
				<div class="col-md-3">
					<div class="box">
						<img src="{{ $news->image }}">
						<h4 class="sub-title">{{ $news->title }}</h4>
						<div class="clearfix"></div>
						- Published by {{$news->publisher()->first()->name}}
						<p class="co-content">
							{{ $news->text }}
						</p>
						<div class="text-right">
							<a class="co-readmore" href="/news/{{ $news->id }}">Read more</a>
						</div>
					</div>
				</div>

				@endforeach	
			</div>
		</div>

		{{-- <ul>
			@foreach ($list as $news)
				<li>
					<a href="/news/{{$news->id}}">{{ $news->title }}</a> <br>- Published by {{$news->publisher()->first()->name}}
				</li>
			@endforeach
		</ul> --}}
	</div>

@endsection