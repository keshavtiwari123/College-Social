@extends('templates.default')

@section('content')
	<h3>Your search for "{{ Request::input('query')}}"</h3>

	@if(!$users->count())
		<p>Sorry! No users with this name try branch or year</p>
	@else
	<div class="row">
		<div class="col-lg-12">
			@foreach($users as $user)
				@include('user/partials/userblock')
			@endforeach	
		</div>
	</div>
	@endif
@endsection