<h1>@yield('title')</h1>



@if($errors->any())
<div class="alert alert-danger">
	@foreach ($errors->all() as $error) 
		<li>{{$error}}</li>
	@endforeach
</div>
@endif


<form method="post" action="{{url('/news')}}" enctype="multipart/form-data">

    {{ csrf_field() }}

	
	<input name="title" type="text" placeholder="Enter title" value="{{ old('title') }}">

	<br>

	<input name="image" type="file" placeholder="select file">

	<br>

	<textarea name="text" id="" cols="30" rows="10"></textarea>

	<br>

	<input type="submit">

</form>