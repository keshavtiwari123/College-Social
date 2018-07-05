<?php $user = $friend ?>
<div class="media">
	<div class="user-detail">
		<a href="{{ route('profile.index', ['username' => $user->username])}}">
			<img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getNameOrUsername()}}">
			<div id="username">
				{{$user->getNameOrUsername()}}	
			</div>
		</a>
	</div>

	<div id="info">
		@if($user->course)
			<strong>{{$user->course}}</strong><br>
		@endif

		@if($user->branch)
			{{$user->branch}} &nbsp;
		@endif

		@if($user->year)
			{{$user->year}}
		@endif
	</div>
	@if(Auth::user()->id == $user->id)
		@include('profile.addFriend')
	@endif

</div>