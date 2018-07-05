@extends('templates.default')

@section('content')

<div class="media">

	<h4>@if(Auth::user()->id == $user->id)
				Your
			@else
				{{$user->getFirstNameOrUsername()}}`s
			@endif Batchmates.
	 </h4>

	@if($batchmates->count() == 1)
		<p>None of 
			@if(Auth::user()->id == $user->id)
				your
			@else
				{{$user->getFirstNameOrUsername()}}`s
			@endif 
				classmates have registered to College Social yet.</p>
				@if(Auth::user()->id == $user->id)
					<p>Or</h4></p><p style="color: red"> you may not have yet updated your profile so we are having trouble retriving information of your Batchmates</p>
					<a href="{{route('profile.edit')}}">Update your Profile</a>
				@endif
	@else
	@foreach($batchmates as $user)
		@include('user.partials.userblock3')
	@endforeach
	@endif
</div>

@endsection