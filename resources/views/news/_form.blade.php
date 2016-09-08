<div class="row">
	<div class="col-md-12">
		<h3><span class="co-underline">Create Your Article</span></h3>
	</div>
</div>
<div class="clearfix"></div><br />
{{-- @if($errors->any())
	<div class="alert alert-danger">
		@foreach ($errors->all() as $error) 
			<li>{{$error}}</li>
		@endforeach
	</div>
@endif
 --}}
<form method="post" action="{{url('/news')}}" enctype="multipart/form-data">
  {{ csrf_field() }}
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6 p-0">
				<div class="{{ $errors->has('title') ? ' has-error' : '' }}"">
					<input name="title" type="text" class="co-input form-control" placeholder="Enter title" value="{{ old('title') }}">
					@if ($errors->has('title'))
		        <span class="help-block">
		          <strong>{{ $errors->first('title') }}</strong>
		        </span>
	        @endif
				</div>
				<div class="clearfix"></div><br />
				<div class="{{ $errors->has('image') ? ' has-error' : '' }}"">
					<input name="image" type="file" class="co-input form-control" placeholder="select file">
					@if ($errors->has('text'))
		        <span class="help-block">
		          <strong>{{ $errors->first('image') }}</strong>
		        </span>
	        @endif
				</div>
				<div class="clearfix"></div><br />
				<div class="{{ $errors->has('text') ? ' has-error' : '' }}"">
					<textarea name="text" id="" cols="30" rows="10" class="form-control co-input co-txtarea" placeholder="Enter your article here"></textarea>
					@if ($errors->has('text'))
		        <span class="help-block">
		          <strong>{{ $errors->first('text') }}</strong>
		        </span>
	        @endif
				</div>
				<div class="clearfix"></div><br />
				<input type="submit" class="co-btn" value="Create">
			</div>
		</div>
	</div>
</form>