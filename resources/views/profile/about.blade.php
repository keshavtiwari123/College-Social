@extends('templates.default')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/about.css')}}">
@section('content')
	<div class="row">
		<div class="col-lg-8">
			<div class="name">
			<h4>{{$user->getNameOrUsername()}}</h4>
		</div>
		<div class="course">
			<h4>Student of {{$user->course}}</h4>
		</div>
		<div class="branch"> 
			@if($user->branch)
				<h4>Studies {{$user->branch}}</h4>
			@endif
		</div>
		<div class="location-current"> 
			@if($user->location)
				<h4>Currently living at {{$user->location}}</h4>
			@endif
		</div>
		<div class="work-current"> 
			@if($user->work)
				<h4>Works at {{$user->work}}</h4>
			@endif
		</div>
		<div class="worked">
			<h4>Worked at:</h4>
			@foreach($user->worked as $work)
				<div id="work">{{$work->worked}} From {{$work->from}} To {{$work->to}}</div>
			@endforeach
		</div>
		<div class="education">
			<h4>Education</h4>
			@foreach($user->education as $education)
				<h4>{{$education->education}} From {{$education->from}} To {{$education->to}}</h4>
			@endforeach
		</div>
		<div class="lived">
			<h4>Places {{$user->getFirstnameOrUsername()}} had Lived</h4>
			@foreach($user->lived as $lived)
				<h4>{{$lived->lived}} From {{$lived->from}} To {{$lived->to}}</h4>
			@endforeach
		</div>
		</div>
	</div>
@endsection