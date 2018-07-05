@extends('templates.default')

@section('content')

<div class="media">

	<h4>@if(Auth::user()->id == $user->id)
				Your
			@else
				{{$user->getFirstNameOrUsername()}}`s
			@endif Classmates.
	 </h4>

	@if($classmates->count() == 1)
		<p>None of 
			@if(Auth::user()->id == $user->id)
				your
			@else
				{{$user->getFirstNameOrUsername()}}`s
			@endif 
				classmates have registered to College Social yet.</p>
				@if(Auth::user()->id == $user->id)
					<p>Or</h4></p><p style="color: red">Either you Or your classmates may not have yet updated their profile so we are having trouble retriving information of your Classmates</p>
					<a href="{{route('profile.edit')}}">Update your Profile</a> and ask your classmates to update their profile
				@endif
	@else
	@foreach($classmates as $user)
	<div >
		@include('user.partials.userblock4')
	</div>
	@endforeach
	@endif
</div>

@endsection