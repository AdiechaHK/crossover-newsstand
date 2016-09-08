<?xml version="1.0" ?>
<rss version="2.0">
	<channel>
		<title>Crossover Newsstand</title>
		<description>This is the RSS feed for Crossover Newsstand Application.</description>

		@foreach($list as $news)

		<item>
			<title>{{$news->title}}</title>
			<description>{{$news->text}}</description>
			<image>
				<url>{{url($news->image)}}</url>
			</image>
			<link>{{url('news/' . $news->id)}}</link>
			<author>{{$news->author->name}}</author>
			<pubDate>{{$news->event_at}}</pubDate>
		</item>

		@endforeach

	</channel>
</rss>