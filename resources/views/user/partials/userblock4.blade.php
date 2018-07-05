<div class="media" style="background-color: white; padding: 5px; border-radius: 5px;">
	<div class="user-detail" >
		<a href="{{ route('profile.index', ['username' => $user->username])}}">
			<img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getNameOrUsername()}}">
			<div id="username">
				{{$user->getNameOrUsername()}}	
			</div>
		</a>
	</div>
		<div class="col-lg-6">
			@include('profile.addFriend')
		</div>
</div>
<br>