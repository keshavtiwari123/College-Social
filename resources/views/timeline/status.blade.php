<div id="status{{$status->id}}" class="status">

		<div class="pull-right" style="cursor: pointer; position: relative; right: 0px; top:0px" onclick="showsettings('{{$status->id}}')" ontouchstart="showsettings('{{$status->id}}')"><h3>&#8942;</h3></div>
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

<div class="user-detail">
	<a href="{{ route('profile.index', ['username' => $status->user->username])}}">
	<img src="{{ $status->user->getAvatarUrl() }}" alt="{{ $status->user->getNameOrUsername()}}" />
	<div id="username">
		{{$status->user->getNameOrUsername()}} 
	</div></a>
	@if($status->user->isOnline())
		<div id="online-dot"></div>
	@endif
	</div>
	<div id="time">
		{{$status->created_at->diffForHumans()}}
	</div>
	<div id="status-body">
		<p id="status-body-less{{$status->id}}">{{ substr(strip_tags($status->body), 0, 200) }}
        @if (strlen(strip_tags($status->body)) > 200)
            <span id="read-more{{$status->id}}" style="color: red; cursor: pointer;" onclick="showPost('{{$status->id}}')"><small>...Read More</small></span>
        @endif
    </p>
    <p id="status-body-full{{$status->id}}" hidden="hidden">{{$status->body}}</p>
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
			<li><a href="{{route('status.Comment', ['statusId' => $status->id])}}">{{$status->replies()->count()}} {{str_plural('comment', $status->replies()->count())}}</a></li>
		</ul>
	</div>


</div>
<br>