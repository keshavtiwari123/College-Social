@extends('templates.default')

@section('content')

<div class="media">

	<h4>@if(Auth::user()->id == $user->id)
				Your
			@else
				{{$user->getFirstNameOrUsername()}}`s
			@endif Colleagues.
	 </h4>

	@if($colleagues->count() == 1)
		<p><h4>None of 
			@if(Auth::user()->id == $user->id)
				your
			@else
				{{$user->getFirstNameOrUsername()}}`s
			@endif 
				Colleagues have registered to College Social yet.</p>
				@if(Auth::user()->id == $user->id)
				<p>Or</h4></p><p style="color: red">Either your colleagues Or you may not have yet updated the profile so we are having trouble retriving information of your Colleagues</p>
				<a href="{{route('profile.edit')}}">Update your Profile</a> Or ask your colleagues to update their`s as well
				@endif
	@else
	@foreach($colleagues as $user)
		@include('user.partials.userblock3')
	@endforeach
	@endif
</div>

@endsection