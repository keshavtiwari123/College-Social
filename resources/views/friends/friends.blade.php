@extends('templates.default')

@section('content')

<div class="media">
	<h4>@if(Auth::user()->id == $user->id)
		Your
	@else	
		{{ $user->getFirstNameOrUsername() }}`s
	@endif	Friends.
	<br><br>
	@if(!$user->friends()->count())
		@if(Auth::user()->id == $user->id)
			You have
		@else	
			{{ $user->getFirstNameOrUsername() }} has
		@endif   no friends.</h4>
		
		@if(Auth::user()->id == $user->id)
		<p>If you are a new user <a href="{{route('profile.edit')}}"><strong>Upadate</strong></a> your <a href="{{ route('profile.index', ['username' => Auth::user()->username])}}">Profile</a><br> and then check your <a href="{{route('user.classmates', ['username' => $user->username])}}">ClassMates</a>, <a href="{{route('user.batchmates', ['username' => $user->username])}}">BatchMates</a> &  <a href="{{route('user.colleagues', ['username' => $user->username])}}">Colleagues</a> and add them as friends</p>
		@endif	
	@else
	@foreach($user->friends() as $friend)
		@include('user.partials.userblockfriends')
	@endforeach
	@endif
</div>

@endsection