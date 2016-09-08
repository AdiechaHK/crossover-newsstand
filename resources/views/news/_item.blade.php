<div class="col-md-3 col-sm-6">
	<div class="box">
		<img src="/{{ $news->image }}">
		<h4 class="sub-title">{{ $news->title }}</h4>
		<div class="clearfix"></div>
		- Published by {{$news->publisher()->first()->name}}
		<p class="co-content">
			{{ $news->text }}
		</p>
		@if (Auth::check() && $news->publisher()->first()->id == Auth::user()->id)
		<form action="/publish/news/{{ $news->id }}" method="POST">
				{{ csrf_field() }}
				<button class="co-btn co-btn-primary" type="submit">{{$news->publish?"Draft":"Publish"}}</button>
		</form>
		

		<div class="pull-left">
			<form action="/news/{{ $news->id }}" method="POST" class="delete-form">
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