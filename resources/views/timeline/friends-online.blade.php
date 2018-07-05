<div style="position: fixed; top: 8%; right: -1%; height: 92%; background-color: white; padding: 10px;  overflow-y: scroll; z-index: 2;">
	<h4>Online</h4>
	@if(Auth::user()->friends()->count())
		@foreach(Auth::user()->friends() as $user)
			@if($user->isOnline())
			<a href="{{route('profile.index', ['username' => $user->username])}}" class="pull-left">
			<img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getNAmeOrUsername() }}" class="media-object" width="40%"  style="border-radius: 500px;">
			</a>
			<h6 class="media-heading"><a href="{{route('profile.index', ['username' => $user->username])}}">{{ $user->getNameOrUsername() }}<div id="online-dot" style="margin-left: 40px;"></div> </a></h6><br>
			@endif
		@endforeach
	@endif
</div>
