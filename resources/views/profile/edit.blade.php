<link rel="stylesheet" href="{{ URL::asset('css/user-detail.css') }}" />
@extends('templates.default')

@section('content')
<div class="pull-left">
<form class="form-vertical" role="form" method="POST" action="{{route('profile.edit.image')}}" enctype="multipart/form-data">
	<div class="col-lg-6">
		<div class="form-group{{ $errors->has('profile') ? ' has-error': ''}}">
			<label for="profile image" class="control-label">Profile Image</label>
			<img src="{{URL::asset('storage/images/')}}/{{Auth::user()->username}}/profile/{{Auth::user()->profile}}" width="320px" style="border-radius: 5px;" />
		
			@if($errors->has('profile'))
				<span class="help-block">{{ $errors->first('profile')}}</span>
			@endif
			<div style="color: grey; height: 70px">
	  			<label for="files" class="btn" style="font-size: 50px"><i class="fa fa-camera-retro"></i></label><br><span style="color: black;">Change Image</span>
				<input type="file" name="profile" id="files" style="visibility:hidden;" onchange="GetFileSizeNameAndType()">
			</div>
		</div>
		<div id="fp"></div>
	</div>
	<div class="form-group" hidden id="UpdateProfile">
		<button type="submit" class="btn btn-primary">Update Profile Image</button>
	</div>
	{{ csrf_field() }}
</form>
</div>
	<div class="row">
		<div class="col-lg-6 pull-right" style="right: 60px;">
			<form class="form-vertical" role="form" method="POST" action="{{route('profile.edit')}}" enctype="multipart/form-data">
				<div class="row">

					<div class="col-lg-6">
						<div class="form-group{{ $errors->has('first_name') ? ' has-error': ''}}">
							<label for="first_name" class="control-label">First Name</label>
							<input type="text" name="first_name" class="form-control" id="first_name" value="{{Request::old('first_name') ?: Auth::user()->first_name}}">	
							@if($errors->has('first_name'))
								<span class="help-block">{{ $errors->first('first_name')}}</span>
							@endif
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group{{ $errors->has('middle_name') ? ' has-error': ''}}">
							<label for="middle_name" class="control-label">Middle Name</label>
							<input type="text" name="middle_name" class="form-control" id="middle_name" value="{{Request::old('middle_name') ?: Auth::user()->middle_name}}">
							@if($errors->has('middle_name'))
								<span class="help-block">{{ $errors->first('middle_name')}}</span>
							@endif
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group{{ $errors->has('last_name') ? ' has-error': ''}}">
							<label for="last_name" class="control-label">Last Name</label>
							<input type="text" name="last_name" class="form-control" id="last_name" value="{{Request::old('last_name') ?: Auth::user()->last_name}}">
							@if($errors->has('last_name'))
								<span class="help-block">{{ $errors->first('last_name')}}</span>
							@endif
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group{{ $errors->has('year') ? ' has-error': ''}}">
								<label for="year" class="control-label">Passing out Year</label>
								<input type="number" maxlength="4" minlength="4" name="year" class="form-control" id="year" value="{{Request::old('year') ?: Auth::user()->year}}">
								@if($errors->has('year'))
									<span class="help-block">{{ $errors->first('year')}}</span>
								@endif
						</div>
					</div><br>

					<div class="col-lg-6">
						<div class="form-group">
							<label for="course" class="control-label">Course</label>
							<select name="course" class="form-control">
								<option class="input-lg" value="B.Tech">B.Tech</option>
							</select>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group">
							<label for="branch" class="control-label">Branch</label>
							
								<select name="branch" class="form-control" >
									<option class="input-lg" selected>
									{{Request::old('branch') ?: Auth::user()->branch ?: "select branch" }}</option>
									<option value="Civil" class="input-lg">Civil</option>
									<option value="Information Technology" class="input-lg">Information Technology</option>
									<option value="Computer Science" class="input-lg">Computer Science</option>
									<option value="Chemical" class="input-lg">Chemical Engineering</option>
									<option value="Mechanical" class="input-lg">Mechanical</option>
									<option value="Electronics and Communication" class="input-lg">Electronics and Communication</option>
									<option value="Electronics and Instrumentation" class="input-lg">Electronics and Instrumentation</option>
									<option value="Electrical Engineering" class="input-lg">Electrical Engineering</option>
								</select>
							
						</div>
					</div>	<br><br>

					<div class="col-lg-15">
						<div class="form-group{{ $errors->has('work') ? ' has-error': ''}}">
								<label for="work" class="control-label">Currently working at</label>
								<input type="text" name="work" class="form-control" id="work" value="{{Request::old('work') ?: Auth::user()->work}}">
								@if($errors->has('work'))
									<span class="help-block">{{ $errors->first('work')}}</span>
								@endif
						</div>
					</div>

				<div class="col-lg-6">
					<div class="form-group{{ $errors->has('location') ? ' has-error': ''}}">
							<label for="location" class="control-label">Current City</label>
							<input type="text" name="location" class="form-control" id="location" value="{{Request::old('location') ?: Auth::user()->location}}">
							@if($errors->has('location'))
								<span class="help-block">{{ $errors->first('location')}}</span>
							@endif
					</div>
				</div>
				
				<div class="col-lg-6">	
					<div class="form-group{{ $errors->has('hometown') ? ' has-error': ''}}">
							<label for="hometown" class="control-label">Hometown</label>
							<input type="text" name="hometown" class="form-control" id="hometown" value="{{Request::old('hometown') ?: Auth::user()->hometown}}">
							@if($errors->has('hometown'))
								<span class="help-block">{{ $errors->first('hometown')}}</span>
							@endif
					</div>
				</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</div>
				{{ csrf_field() }}
			</form>
		</div>
	</div>
	<div class="pull-right col-lg-6" style="color: #3bbced;">
		The form above helps us to get information about your classmates, batchmates and colleagues so make sure you provide us correct information for your best experience. 
	</div>

<br><br>
	<div style="padding: 1px; background-color: white"></div>

<!-- Work detail -->

	<div class="col-lg-9 pull-left">
		<h3 style="color: black;"><b>Work:</b></h3>
		<span>
			@foreach(Auth::user()->worked as $work)
				@include('profile.work')
			@endforeach	
		</span><br>
		<div id="add-work" class="btn btn-primary"><span style="border: 1px dashed white; padding: 2px;">+</span> Add Work Place</div>
			<form action="{{route('work.add')}}" method="POST" class="form-vertical" role="form" id="add-work-form" hidden="" style="background-color: white; padding: 5px; border-radius: 5px;">
				<div class="col-lg-20 form-group">
					<label for="lived" class="control-label" style="color: black;">Add a place where you have Worked</label>
					<input type="text" name="worked" class="form-control" id="worked">
				</div>
				<div class="col-lg-6 form-group">
					<label for="from" class="control-label">From</label>
					<input type="number" name="from" id="from" class="form-control">
				</div>
				<div class="col-lg-6 form-group">
					<label for="to" class="control-label">To</label>
					<input type="number" name="to" id="to" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Add Work Status</button>
				</div>
					{{ csrf_field() }}
			</form>
	</div>
	

<!-- Education Detail -->

	<div class="col-lg-9 pull-left">
		<h3 style="color: black;"><b>Eduction:</b></h3>
		<div>
			@foreach(Auth::user()->education as $education)
				@include('profile.education')
			@endforeach	
		</div><br>
		<div id="add-education" class="btn btn-primary"><span style="border: 1px dashed white; padding: 2px;">+</span> Add Education</div>
			<form action="{{route('education.add')}}" method="POST" class="form-vertical" role="form" id="add-education-form" hidden="" style="background-color: white; padding: 5px; border-radius: 5px;">
				<div class="col-lg-20 form-group">
					<label for="education" class="control-label" style="color: black;">Add a place where you have Studied</label>
					<input type="text" name="education" class="form-control" id="education">
				</div>
				<div class="col-lg-6 form-group">
					<label for="from" class="control-label">From</label>
					<input type="number" name="from" id="from" class="form-control">
				</div>
				<div class="col-lg-6 form-group">
					<label for="to" class="control-label">To</label>
					<input type="number" name="to" id="to" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Add Education Status</button>
				</div>
					{{ csrf_field() }}
			</form>
	</div>

	<!-- living detail -->


	<div class="col-lg-9 pull-left">
		<h3 style="color: black;"><b>Places you`ve lived:</b></h3>
		<span>
			@foreach(Auth::user()->lived as $lived)
				@include('profile.lived')
			@endforeach	
		</span><br>
		<div id="add-lived" class="btn btn-primary"><span style="border: 1px dashed white; padding: 2px;">+</span> Add New Place</div>
			<form action="{{route('lived.add')}}" method="POST" class="form-vertical" role="form" id="add-lived-form" hidden="" style="background-color: white; padding: 5px; border-radius: 5px;">
				<div class="col-lg-20 form-group">
					<label for="lived" class="control-label" style="color: black;">Add a place where you have lived</label>
					<input type="text" name="lived" class="form-control" id="lived">
				</div>
				<div class="col-lg-6 form-group">
					<label for="from" class="control-label">From</label>
					<input type="number" name="from" id="from" class="form-control">
				</div>
				<div class="col-lg-6 form-group">
					<label for="to" class="control-label">To</label>
					<input type="number" name="to" id="to" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit this address</button>
				</div>
					{{ csrf_field() }}
			</form>
	</div>

	<script type="text/javascript">
		document.getElementById('add-work').onclick = function() {
    		document.getElementById('add-work-form').style.display = 'block';
		};

		document.getElementById('add-education').onclick = function() {
    		document.getElementById('add-education-form').style.display = 'block';
		};

		document.getElementById('add-lived').onclick = function() {
    		document.getElementById('add-lived-form').style.display = 'block';
		};

		function show_form(id){
			$("#edit-work"+id).click(function(){
				$("#edit-work-form"+id).show();
			});

			$("#edit-education"+id).click(function(){
				$("#edit-education-form"+id).show();
			});

			$("#edit-lived"+id).click(function(){
				$("#edit-lived-form"+id).show();
			});
		}
	</script>
@endsection