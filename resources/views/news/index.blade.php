@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="pull-right">
			@if (Auth::check())
				<a href="" class="co-btn">Create New!</a>
			@endif
		</div>

		@if(Session::has('notification'))
			<h3 class="text-success">{{Session::get('notification')}}</h3>
		@endif

		<h3><span class="co-underline">News</span></h3>
		<div class="clearfix"></div><br />

		<div class="row">
			<div class="col-md-12">
				@foreach ($list as $i=>$news)
					<div class="col-md-3">
						<div class="box">
							<img src="/{{ $news->image }}">
							<h4 class="sub-title">{{ $news->title }}</h4>
							<div class="clearfix"></div>
							- Published by {{$news->publisher()->first()->name}}
							<p class="co-content">
								{{ $news->text }}
							</p>
							@if (Auth::check() && $news->publisher()->first()->id == Auth::user()->id)
							<div class="pull-left">
								<form action="/news/{{ $news->id }}" method="POST">
										{{ csrf_field() }}
										<input type="hidden" name="_method" value="DELETE">
										<button class="co-btn co-btn-danger" type="submit">Delete</button>
								</form>
							</div>
							@endif
							<div class="text-right">
								<a class="co-btn" href="/news/{{ $news->id }}">Read more</a>
							</div>
						</div>
					</div>
					@if( ($i+1) % 4 == 0 )
						<div class="clearfix"></div><br />
					@endif
				@endforeach	
			</div>
		</div>
	</div>
	<div class="clearfix"></div><br />
@endsection