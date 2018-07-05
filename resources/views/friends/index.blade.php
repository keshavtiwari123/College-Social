@extends('templates.default')

@section('content')
	<div class="row">

		<div class="col-lg-6">
			@if(!$requests->count())
				<h3>You have no friend requests</h3>
			@else
				<h3>friend requests</h3>
				@foreach($requests as $user)
					@include('user/partials/userblock')
				@endforeach	
			@endif
		</div>

		
			<div style="background-color: #f0f0f0; padding:2px"></div>
		

		<div class="col-lg-6">
			@if(!$friends->count())
				<h3>You have no friends yet</h3>
			@else
				<h3>Your Friends</h3>
				@foreach($friends as $user)
					@include('user/partials/userblock2')
				@endforeach	
			@endif
		</div>
	</div>
@endsection