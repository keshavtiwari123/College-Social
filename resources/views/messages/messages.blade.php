<link rel="stylesheet" type="text/css" href="{{URL::asset('css/message-body-desktop.css')}}">
<meta name="viewport" content="width=device-width, initial-scale=1,  maximum-scale=1.0, minimum-scale=1.0">
<div class="messages">
	<div class="home">
		<a href="{{route('home')}}" target="_blank"><i class="fa fa-home"></i>Home</a>
	</div>
<a href="{{ route('profile.index', ['username' => $sender->username])}}" target="_blank">
	<div id="user">
		{{$sender->getNameOrUsername()}}
	</div>
</a>
<div style="padding: 30px"></div>
<div id="all-the-messages"> 
	@foreach( $messages as $message)
			@if($message->sender_id == $sender->id && $message->user_id == Auth::user()->id)
			<img src="{{ $sender->getAvatarUrl() }}" alt="{{ $sender->getNameOrUsername()}}" id="img-left">
			<div class="left message">
					<span id="body">
					{{$message->body}}
				</span>
					<div id="time-left"><b>{{$message->created_at->format('h:i A D d-M-Y')}}</b></div>
			</div>
			@elseif($message->sender_id == Auth::user()->id && $message->user_id == $sender->id)
			<img src="{{ auth::user()->getAvatarUrl() }}" alt="{{ auth::user()->getNameOrUsername()}}" id="img-right">
				<div class="right message">
					<span id="body">
					{{$message->body}}
					</span>
					<div id="time-right"><b>{{$message->created_at->format('h:i A  D d-M-y')}}</b></div>
				</div>
			@endif
			
			<div style="padding: 2px;"></div>
	@endforeach
</div>

<div style="padding: 30px"></div>

<form id="msg-form">
	<input type="text" name="message" id="message" for="message" placeholder="Type your message" autofocus  autocomplete="no">
	{{csrf_field()}}
</form>
</div>
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).scrollTop(document.body.scrollHeight);
		setInterval(function(){
			$('#all-the-messages').load(document.URL +  ' #all-the-messages');
			$(document).scrollTop(document.body.scrollHeight*1.2);
		
		}, 5000);
	});

	$("#msg-form").submit(function(e){
		e.preventDefault();
		var URL = "{{route('message.send', ['senderId' =>  $sender->id])}}";
		$.ajax({
			type: "POST",
			url: URL,
			data: $("#msg-form").serialize(),
			success: function(){
				$("#message").val("");
			}
		});
	});
</script>
