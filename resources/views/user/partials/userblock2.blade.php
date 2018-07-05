<div class="media">
	<a href="{{route('profile.index', ['username' => $user->username])}}" class="pull-left">
		<img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getNAmeOrUsername() }}" class="media-object"  width="60%"  style="border-radius: 500px;">
	</a>
	<div class="media-body">
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
		
	</div>
</div>