@extends('layouts.app')

@section('content')

	<div class="container">
		<h3><span class="co-underline">{{$news->title}}</span></h3>
		<h5 class="sub-title-light">- {{ $news->publisher()->first()->name }}</h5>
		<div class="clearfix"></div><br />
		
		<div class="row">
			<div class="col-md-8">
				<img src="{{url($news->image)}}" alt="{{ $news->title }}" class="img-responsive">
				<div class="clearfix"></div><br />
				<p>{{$news->text}}</p>
			</div>
			
			<div class="col-md-4">
				@foreach($top_news as $news_list)
					<a href="/news/{{ $news_list->id }}" class="co-no-link">
						<div class="col-md-12 clearfix box-related">
							<div class="col-md-3">
								<img src="/{{ $news_list->image }}" class="img-responsive">
							</div>
							<div class="col-md-9">
								<h4 class="p-0 m-0">{{ $news_list->title }}</h4>
								<p class="co-content">{{ $news_list->text }}</p>
							</div>
						</div>
					</a>
				@endforeach
			</div>
		</div>
		<div class="clearfix"></div><br />
		<a class="co-btn" href="/news">Back to news list</a>
		<div class="clearfix"></div><br />
	</div>


@endsection