@extends('templates.default')

@section('content')
		<div class="row">
		<div class="col-lg-6">
			<form role="form" action="{{route('status.post.edit', ['statusId' => $status->id])}}" method="POST" enctype="multipart/form-data">
				<div class="form-group{{ $errors->has('status') ? ' has-error' : ''}}">
							
					<textarea name="status" class="form-control" rows="5" placeholder="write something here {{Auth::user()->getFirstnameOrUsername()}}" autofocus="autofocus">{{$status->body}}</textarea>
					@if($errors->has('status'))
						<span class="help-block">{{$errors->first('status')}}</span>
					@endif
				</div>

				<div>
	  				<label for="files" class="btn"><i class="fa fa-camera-retro" style="font-size: 50px"></i><br>Add Images</label>
					<input type="file" name="image[]" multiple="true" id="files" style="visibility:hidden;" onchange="GetFileSizeNameAndType()">
				</div>
				<div id="fp"></div>
    			<p> <div id="divTotalSize"></div> </p>

<button type="submit" class="btn btn-default">Update Edited Status</button>
{{csrf_field()}}
			</form>
<br><br>
	@foreach($status->images as $image)
		<img src="{{URL::asset('storage/images/')}}/{{$status->user->username}}/{{$image->image}}" width="300px">
		<a href="{{route('status.Delete.image', ['imageId' => $image->id, 'statusId' => $status->id])}}">Delete</a><br><br>
	@endforeach
		</div>
	</div>
@endsection