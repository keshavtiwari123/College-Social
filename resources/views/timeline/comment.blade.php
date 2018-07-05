@extends('templates.default')

@section('content')
<div id="status{{$status->id}}" class="col-lg-6 status">
<div class="user-detail">
	<a href="{{ route('profile.index', ['username' => $status->user->username])}}">
	<img src="{{ $status->user->getAvatarUrl() }}" alt="{{ $status->user->getNameOrUsername()}}">
	<div id="username">
		{{$status->user->getNameOrUsername()}}	
	</div></a>
	</div>
	<div id="time">
		{{$status->created_at->diffForHumans()}}
	</div>
	<div id="status-body">
		<p>{{$status->body}}</p>
	</div>

<?php $i = 0; $x = $status->images->count(); ?>
@if($x > 1)
<div class="slideshow-container">
	@foreach($status->images as $image)
	<div class="mySlides{{$status->id}} " style="display: hidden">
    		<div class="image-container">
    		<div class="numbertext">{{$i + 1}} / {{$x}}</div>    			
				<a href="{{URL::asset('storage/images/')}}/{{$status->user->username}}/{{$image->image}}" target="_blank"><img src="{{URL::asset('storage/images/')}}/{{$status->user->username}}/{{$image->image}}"></a>
			</div>
  		</div>
	@endforeach
	<a class="prev" onclick="plusSlides(-1, '{{$status->id}}')">&#10094;</a>
	<a class="next" onclick="plusSlides(1, '{{$status->id}}')">&#10095;</a>
	</div>
<br>


<div style="text-align:center">
	@for($i = 0; $i < $x; $i++)
  		<span class="dot{{$status->id}} dot" onclick="currentSlide({{$i + 1}}, '{{$status->id}}')"></span> 
  	@endfor 
</div>
<script type="text/javascript">
	showSlides(1, '{{$status->id}}');
</script>
@elseif($x == 1)
<div class="slideshow-container">
<div class="image-container">
	@foreach($status->images as $image)
	<a href="{{URL::asset('storage/images')}}/{{$status->user->username}}/{{$image->image}}"  target="_blank"><img src="{{URL::asset('storage/images')}}/{{$status->user->username}}/{{$image->image}}"/></a>
	@endforeach
	</div></div>
@endif

	<div id="like{{$status->id}}" class="like-comment" style="font-family: 'Tillana', cursive;">
		<ul class="list-inline" id="like-comment">
			<li><div id="{{$status->id}}"
			 onclick="like('{{$status->id}}', '{{route('status.like', ['statusId' => $status->id])}}') ">
				@if(Auth::user()->hasLikedStatus($status))
					<i class="fa fa-thumbs-up" style="color: #3bbced;"></i>
				@else	
					<i class="fa fa-thumbs-o-up"  style="color: grey"></i>
				@endif
			</div></li>
			<li><a href="{{route('like.list', ['statusId' => $status->id])}}">{{$status->likes()->count()}} {{str_plural('like', $status->likes()->count())}}</a></li>
			<li><a href="{{route('status.Comment', ['statusId' => $status->id])}}"><i class="fa fa-comments-o"></i></a></li>
			<li><a href="{{route('status.Comment', ['statusId' => $status->id])}}">{{$status->replies()->count()}} {{str_plural('comment', $status->replies()->count())}}</li></a>
		</ul>

	</div>

		<hr>
		@if(Auth::user()->isFriendsWith($status->user) || Auth::user()->id === $status->user->id)
		<div class="col-lg-19">
		<form role="form" action="{{route('status.reply', ['statusId' => $status->id])}}" enctype="multipart/form-data" method="POST">
			<div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error': '' }}">
				<textarea name="reply-{{ $status->id}}" class="form-control" rows="2" placeholder="Reply to this post" autofocus="autofocus" ></textarea>
				@if( $errors->has("reply-{$status->id}") )
					<span class="help-block">
						{{$errors->first("reply-{$status->id}")}}
					</span>
				@endif
			</div>
			<div style="color: grey;">
	  			<label for="files" class="btn" style="font-size: 50px"><i class="fa fa-camera-retro" style="color: black;"></i></label>
				<input type="file" name="image[]" multiple="true" id="files" style="visibility:hidden;" onchange="GetFileSizeNameAndType()">
			</div>
			<div id="fp"></div>
    			<p><div id="divTotalSize"></div></p>
			<input type="submit" value="Reply" class="btn btn-default btn-sm">
			{{csrf_field()}}
		</form>	
	</div>
	@else
	<p style="color: red">Add {{$status->user->getFirstNameOrusername()}} as Friend to comment on their posts.</p>
	@endif

		<hr><h3>Comments</h3><br>

		@foreach($status->replies as $reply)
		<div id="status{{$reply->id}}">

<div class="pull-right" style="cursor: pointer" onclick="showsettings('{{$reply->id}}')" ontouchstart="showsettings('{{$reply->id}}')"><h3>&#8942;</h3></div>

							<div class="pull-right"  hidden="" id="hiddenSettings{{$reply->id}}" style="max-width: auto; text-align: center">
			@if(Auth::user()->id === $reply->user->id)
				<a href="{{route('status.Edit', ['statusId' => $reply->id])}}" id="edit">
				<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					Edit</a><br>
				<a href="{{route('status.Delete', ['statusId' => $reply->id])}}" id="delete">
					<i class="fa fa-trash-o fa-lg" style="color: red"></i> Delete</a><br>
			@else	
				<a href="#" id="report">
					<i class="fa fa-user-secret" aria-hidden="true" style="color: red; font-size: 30px"></i>&nbsp;Report</a>	
			@endif
		</div>
<div id="status{{$reply->id}}" >
<div class="user-detail">
	<a href="{{ route('profile.index', ['username' => $reply->user->username])}}">
	<img src="{{ $reply->user->getAvatarUrl() }}" alt="{{ $reply->user->getNameOrUsername()}}" style="width: 40px">
	<div id="username" style="font-size: 16px;">
		{{$reply->user->getNameOrUsername()}}	
	</div></a><div style="padding: 3px"></div>
	</div>
	<div id="time" style="font-size: 12px;">
		{{$reply->created_at->diffForHumans()}}
	</div>
	<div id="status-body" style="font-size: 15px;">
		<p>{{$reply->body}}</p>
	</div>

<?php $i = 0; $x = $reply->images->count(); ?>
@if($x > 1)
<div class="slideshow-container">
	@foreach($reply->images as $image)
	<div class="mySlides{{$reply->id}} " style="display: hidden">
    		<div class="image-container">
    		<div class="numbertext">{{$i + 1}} / {{$x}}</div>    			
				<a href="{{URL::asset('storage/images/')}}/{{$reply->user->username}}/{{$image->image}}" target="_blank"><img src="{{URL::asset('storage/images/')}}/{{$reply->user->username}}/{{$image->image}}" width="70%"></a>
			</div>
  		</div>
	@endforeach
	<a class="prev" onclick="plusSlides(-1, '{{$reply->id}}')">&#10094;</a>
	<a class="next" onclick="plusSlides(1, '{{$reply->id}}')">&#10095;</a>
	</div>
<br>


<div style="text-align:center">
	@for($i = 0; $i < $x; $i++)
  		<span class="dot{{$reply->id}} dot" onclick="currentSlide({{$i + 1}}, '{{$reply->id}}')"></span> 
  	@endfor 
</div>
<script type="text/javascript">
	showSlides(1, '{{$reply->id}}');
</script>
@elseif($x == 1)
<div class="slideshow-container">
<div class="image-container">
	@foreach($reply->images as $image)
	<a href="{{URL::asset('storage/images')}}/{{$reply->user->username}}/{{$image->image}}"  target="_blank"><img src="{{URL::asset('storage/images')}}/{{$reply->user->username}}/{{$image->image}}" width="70%" /></a>
	@endforeach
	</div></div>
@endif
			
<div id="like{{$reply->id}}" class="like-comment" style="font-family: 'Tillana', cursive;">
		<ul class="list-inline" id="like-comment">
			<li><div id="{{$reply->id}}"
			 onclick="like('{{$reply->id}}', '{{route('status.like', ['statusId' => $reply->id])}}') ">
				@if(Auth::user()->hasLikedStatus($reply))
					<i class="fa fa-thumbs-up" style="color: #3bbced; font-size: 20px;"></i>
				@else	
					<i class="fa fa-thumbs-o-up"  style="color: grey; font-size: 20px;"></i>
				@endif
			</div></li>
			<li><a href="{{route('like.list', ['statusId' => $reply->id])}}">{{$reply->likes()->count()}} {{str_plural('like', $reply->likes()->count())}}</a></li>
			<li><a href="{{route('status.Comment', ['statusId' => $reply->id])}}"><i class="fa fa-comments-o" style="font-size: 20px;"></i></a></li>
			<li><a href="{{route('status.Comment', ['statusId' => $reply->id])}}">{{$reply->replies()->count()}} {{str_plural('reply', $reply->replies()->count())}}</a></li>
			</ul>

	</div>

		<hr>
	@endforeach	
</div>


@endsection
