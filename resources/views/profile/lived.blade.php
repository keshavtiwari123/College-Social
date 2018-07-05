<div class="lived-detail lived{{$lived->id}}" ">
	<div id="place">
		{{$lived->lived}}
	</div>
	<div id="form-to">
		From: <span id="form">{{$lived->from}}</span> &nbsp; &nbsp;
		To: <span id="form">{{$lived->to}}</span>
	</div><br><br>
	

@if(Auth::user()->id == $lived->user->id)
	<ul class="list-inline pull-right" id="edit-delete">
		<li><div id="delete"><i class="fa fa-trash-o"></i>
			<a href="{{route('lived.delete', ['livedId' => $lived->id])}}"><small>Delete</small></a>
		</div></li>
		<li><div id="edit-lived{{$lived->id}}" onclick="show_form('{{$lived->id}}')" style="cursor: pointer;"><i class="fa fa-pencil-square-o" ></i><small>Edit</small></div></li>
	</ul>
	<form action="{{route('lived.edit', ['livedId' => $lived->id])}}" method="POST" class="form-vertical" role="form" id="edit-lived-form{{$lived->id}}" hidden="">
		<div class="col-lg-20 form-group">
			<label for="lived" class="control-label" style="color: black;">Edit Address</label>
			<input type="text" name="lived" class="form-control" id="lived" value="{{$lived->lived}}">
		</div>
		<div class="col-lg-6 form-group">
			<label for="from" class="control-label">From</label>
			<input type="number" name="from" id="from" class="form-control" value="{{$lived->from}}">
		</div>
		<div class="col-lg-6 form-group">
			<label for="to" class="control-label">To</label>
			<input type="number" name="to" id="to" class="form-control" value="{{$lived->to}}">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-sm">Update Address</button> &nbsp;
			<a href="{{route('lived.delete', ['livedId' => $lived->id])}}" class="btn btn-primary" style="color: red;"><small>Delete Address</small></a>
		</div>
			{{ csrf_field() }}
			
	</form>
@endif
</div>