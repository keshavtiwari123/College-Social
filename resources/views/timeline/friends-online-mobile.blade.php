@extends('templates.default')
<div style="background-color: white; padding: 10px; border-radius: 10px;">
	<h4>People Online</h4>
	@if(Auth::user()->friends()->count())
		@foreach(Auth::user()->friends() as $user)
			@if($user->isOnline())
			<a href="{{route('profile.index', ['username' => $user->username])}}" class="pull-left">
			<img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getNAmeOrUsername() }}" class="media-object" width="40%"  style="border-radius: 500px;">
			</a>
			<h6 class="media-heading"  style="max-width: 100px"><a href="{{route('profile.index', ['username' => $user->username])}}">{{ $user->getNameOrUsername() }} </a></h6><br>
			@endif
		@endforeach
	@endif
</div>
