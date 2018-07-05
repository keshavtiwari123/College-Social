<div class="education-detail education{{$education->id}}" >
	<div id="place">
		{{$education->education}}
	</div>
	<div id="form-to">
		From: <span id="form">{{$education->from}}</span> &nbsp; &nbsp;
		To: <span id="form">{{$education->to}}</span>
	</div><br><br>
	

@if(Auth::user()->id == $education->user->id)
	<ul class="list-inline pull-right" id="edit-delete">
		<li><div id="delete"><i class="fa fa-trash-o"></i>
			<a href="{{route('education.delete', ['educationId' => $education->id])}}"><small>Delete</small></a>
		</div></li>
		<li><div id="edit-education{{$education->id}}" onclick="show_form('{{$education->id}}')" style="cursor: pointer;"><i class="fa fa-pencil-square-o" ></i><small>Edit</small></div></li>
	</ul>
	<form action="{{route('education.edit', ['educationId' => $education->id])}}" method="POST" class="form-vertical" role="form" id="edit-education-form{{$education->id}}" hidden="">
		<div class="col-lg-20 form-group">
			<label for="lived" class="control-label" style="color: black;">Edit Education</label>
			<input type="text" name="education" class="form-control" id="education" value="{{$education->education}}">
		</div>
		<div class="col-lg-6 form-group">
			<label for="from" class="control-label">From</label>
			<input type="number" name="from" id="from" class="form-control" value="{{$education->from}}">
		</div>
		<div class="col-lg-6 form-group">
			<label for="to" class="control-label">To</label>
			<input type="number" name="to" id="to" class="form-control" value="{{$education->to}}">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-sm">Update Education</button> &nbsp;
			<a href="{{route('education.delete', ['educationId' => $education->id])}}" class="btn btn-primary" style="color: red;"><small>Delete Education</small></a>
		</div>
			{{ csrf_field() }}
			
	</form>
@endif
</div>