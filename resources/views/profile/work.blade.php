<div class="work-detail work{{$work->id}}">
	<div id="place">
		{{$work->worked}}
	</div>
	<div id="form-to">
		From: <span id="form">{{$work->from}}</span> &nbsp; &nbsp;
		To: <span id="form">{{$work->to}}</span>
	</div><br><br>
	

@if(Auth::user()->id == $work->user->id)
	<ul class="list-inline pull-right" id="edit-delete">
		<li><div id="delete"><i class="fa fa-trash-o"></i>
			<a href="{{route('work.delete', ['workId' => $work->id])}}"><small>Delete</small></a>
		</div></li>
		<li><div id="edit-work{{$work->id}}" onclick="show_form('{{$work->id}}')" style="cursor: pointer;"><i class="fa fa-pencil-square-o" ></i><small>Edit</small></div></li>
	</ul>
	<form action="{{route('work.edit', ['workId' => $work->id])}}" method="POST" class="form-vertical" role="form" id="edit-work-form{{$work->id}}" hidden="">
		<div class="col-lg-20 form-group">
			<label for="lived" class="control-label" style="color: black;">Edit Work Place</label>
			<input type="text" name="worked" class="form-control" id="worked" value="{{$work->worked}}">
		</div>
		<div class="col-lg-6 form-group">
			<label for="from" class="control-label">From</label>
			<input type="number" name="from" id="from" class="form-control" value="{{$work->from}}">
		</div>
		<div class="col-lg-6 form-group">
			<label for="to" class="control-label">To</label>
			<input type="number" name="to" id="to" class="form-control" value="{{$work->to}}">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-sm">Update Work</button> &nbsp;
			<a href="{{route('work.delete', ['workId' => $work->id])}}" class="btn btn-primary" style="color: red;"><small>Delete work</small></a>
		</div>
			{{ csrf_field() }}
			
	</form>
@endif
</div>