@extends('templates.default')

@section('content')
<div style="background-color: white; border-radius: 5px; padding: 5px;">
	@foreach($status->likes as $like)
	<div class="user-detail" >
		<a href="{{ route('profile.index', ['username' => $like->user->username])}}">
		<img src="{{ $like->user->getAvatarUrl() }}" alt="{{ $like->user->getNameOrUsername()}}">
		<div id="username">
			{{$like->user->getNameOrUsername()}}
		</div></a>
		<br><br>
	</div>
	@endforeach
</div>
@endsection