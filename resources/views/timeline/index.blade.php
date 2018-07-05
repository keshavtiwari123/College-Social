@extends('templates.default')	
@section('content')
	<div class="row">
		<div class="col-lg-8">
			<form role="form" action="{{route('status.post')}}" method="POST" enctype="multipart/form-data">
				<div class="form-group{{ $errors->has('status') ? ' has-error' : ''}}" style="margin: 0px; padding: 0px">
					<textarea name="status" class="form-control" rows="3" placeholder="write something here {{Auth::user()->getFirstnameOrUsername()}}"></textarea>
					@if($errors->has('status'))
						<span class="help-block">{{$errors->first('status')}}</span>
					@endif
					<div style="color: grey; height: 70px;">
	  					<label for="files" class="btn" style="font-size: 50px; color: black;"><i class="fa fa-camera-retro"></i></label>
						<input type="file" name="image[]" multiple="true" id="files" style="visibility:hidden;" onchange="GetFileSizeNameAndType()">
					</div>
				</div>
				<div id="fp"></div>
    			<p><div id="divTotalSize"></div></p>
				<button type="submit" class="btn btn-primary">Update Status</button>
				{{csrf_field()}}
			</form>
		</div>
	</div>
	<br><div style="padding: 1px; background-color: white; margin-left: -100px; margin-right: -15px;"></div><br>

	<div class="row">
		<div class="col-lg-6">
			@if(!$statuses->count())
				<p>There is not more to show in your Timeline as you may not have any <a href="{{route('friends.index')}}">Friends</a> yet.</p>
				<p><a href="{{route('profile.edit')}}"><strong>Upadate</strong></a> your <a href="{{ route('profile.index', ['username' => Auth::user()->username])}}">Profile</a> and check your <a href="{{route('user.classmates', ['username' => $user->username])}}">ClassMates</a>, <a href="{{route('user.batchmates', ['username' => $user->username])}}">BatchMates</a> &  <a href="{{route('user.colleagues', ['username' => $user->username])}}">Colleagues</a> and add them as friends</p>
				<p>You will not be able to see your classmates batchmates or colleagues <strong>Unless</strong> you update your profile</p>
				<p>Or just search people using their names or college or passing-out year or branch etc.</p>
			@else
				@foreach($statuses as $status)
					@include('timeline.status')
				@endforeach
				{!! $statuses->render() !!}
			@endif
		</div>
	</div>
@endsection