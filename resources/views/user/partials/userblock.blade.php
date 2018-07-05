<div class="media" style="background-color: white; padding: 2px; border-radius: 2px; width: 70%">
	<a href="{{route('profile.index', ['username' => $user->username])}}" class="pull-left">
		<img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getNAmeOrUsername() }}" class="media-object" width="60%"  style="border-radius: 500px;">
	</a>
	<div class="media-body" >
		<h4 class="media-heading"><a href="{{route('profile.index', ['username' => $user->username])}}">{{ $user->getNameOrUsername() }} </a></h4>

		@if($user->course)
			<p><strong>{{$user->course}}</strong></p>
		@endif

		@if($user->branch  )
			<p>{{$user->branch}} &nbsp;
		@endif

		@if($user->year)
			{{$user->year}} </p><br>
		@endif
		<div class="col-lg-6">
			@include('profile.addFriend')<hr>
		</div>
		
	</div>
</div>