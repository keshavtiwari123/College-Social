@extends('templates.default')

@section('content')
	<div class=""><h4>
		@if(Auth::user()->id === $user->id)
			Your &nbsp;
		@else	
			{{$user->getFirstNameOrUsername()}}`s &nbsp;
		@endif
		<a href="{{route('user.classmates', ['username' => $user->username])}}">ClassMates</a>, &nbsp;
		<a href="{{route('user.batchmates', ['username' => $user->username])}}">BatchMates</a> & &nbsp;
		<a href="{{route('user.colleagues', ['username' => $user->username])}}">Colleagues</a>. 
		
	</h4></div><br>
	<div class="col-lg-5 pull-right">
		<a href="{{$user->getAvatarUrlFull()}}">
		<img src="{{$user->getAvatarUrlFull()}}" alt="{{ $user->getNameOrUsername()}}" class="media-object" width="100%" style="border-radius: 10px; margin-left: -50px;"></a>
		@include('profile.addFriend')
		<br>
		@if (Auth::user()->isFriendsWith($user))
			<form action="{{route('friend.delete', ['username' => $user->username]) }}" method="post">
					<input class="btn btn-primary" type="submit" name="submit" value="Remove as Friend">
					{{csrf_field()}}
			</form>
		@endif
		
		studies {{$user->branch}}<br>
		from {{$user->hometown}}<br>
		lives in {{$user->location}}<br>
	</div><br>

	<div class="row">
		<div class="col-lg-5">
			
			
				<div class="col-lg-20">
					<h4>
					<a href="{{route('user.about', ['username' => $user->username])}}">About</a> &nbsp;
					<a href="{{route('user.friends', ['username' => $user->username])}}">Friends</a> &nbsp;
					@if($user->id != Auth::user()->id) 
						<a href="{{route('messages.messages', ['senderId' => $user->id])}}">message</a> &nbsp; 
					@endif	
					</h4>
				</div>
			
			<hr>
			@foreach($statuses as $status)
					@include('timeline.status')
			@endforeach
			{!! $statuses->render() !!}
		</div>
		<div class="col-lg-4 col-lg-offset-3">


		</div>
	</div>	
@endsection	