		<div class="pull-right" style="cursor: pointer" onclick="showsettings('{{$status->id}}')" ontouchstart="showsettings('{{$status->id}}')"><h3>&#8942;</h3></div>
		<div class="pull-right"  hidden="" id="hiddenSettings{{$status->id}}" style="max-width: auto; text-align: center">
			@if(Auth::user()->id === $status->user->id)
				<a href="{{route('status.Edit', ['statusId' => $status->id])}}" id="edit">
				<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					Edit</a><br>
				<a href="{{route('status.Delete', ['statusId' => $status->id])}}" id="delete">
					<i class="fa fa-trash-o fa-lg" style="color: red"></i> Delete</a><br>
			@else	
				<a href="#" id="report">
					<i class="fa fa-user-secret" aria-hidden="true" style="color: red; font-size: 30px"></i>&nbsp;Report</a>
			@endif
		</div>