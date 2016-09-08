<div class="col-md-3 col-sm-6">
	<div class="box">
		<img src="/{{ $news->image }}">
		<h4 class="sub-title">
			{{ $news->title }}
			<br>
			<small class="co-date">{{ $news->event_at() }}</small>
		</h4>
		<div class="clearfix"></div>
		- Published by {{$news->publisher()->first()->name}}
		<p class="co-content">
			{{ $news->text }}
		</p>
		

		<div>
			@if (Auth::check() && $news->publisher()->first()->id == Auth::user()->id)
				<form action="/news/{{ $news->id }}" method="POST" class="delete-form">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="DELETE">
						<button class="co-btn co-btn-sm co-btn-danger pull-left" type="submit">Delete</button>
				</form>
				<form action="/publish/news/{{ $news->id }}" method="POST">
						{{ csrf_field() }}
						<button class="co-btn co-btn-sm m-l-5 co-btn-primary pull-left" type="submit">{{$news->publish?"Draft":"Publish"}}</button>
				</form>
			@endif
			<div class="text-right">
				<a class="co-btn co-btn-sm" href="/news/{{ $news->id }}">Read more</a>
			</div>
		</div>
	</div>
</div>