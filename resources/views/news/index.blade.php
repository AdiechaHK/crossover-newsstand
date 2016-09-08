@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="pull-right">
			@if (Auth::check())
				<a href="/news/create" class="co-btn">Create New!</a>
			@endif
		</div>

		@if(Session::has('notification'))
			<h3 class="text-success">{{Session::get('notification')}}</h3>
		@endif

		@if(count($list) > 0) 
			<h3><span class="co-underline">News</span></h3>
			<div class="clearfix"></div><br />

			<div class="row">
				<div class="col-md-12" id="news-container">
					@foreach ($list as $i=>$news)
						@include('news/_item')
					@endforeach	
				</div>
			</div>
		@else 
			<h3>No news to show, as of now.</h3>
		@endif
	</div>
	<div class="clearfix"></div><br />
	@if (Auth::check() && count($list) > 0) 
		<div class="co-load-more-container">
			<button class="co-btn" id="load-more" data-url="{{url('/load/news')}}">Load more</button>
		</div>
	@endif


@endsection