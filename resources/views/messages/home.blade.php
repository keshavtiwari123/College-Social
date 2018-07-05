@extends('templates.default')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/message-desktop.css')}}">

@section('content')
<script type="text/javascript">
			$(window).load(function(){
				alert('hekcvn');
				var contents = $("#ifr").contents();
				$contents.scrollTop($contents.height());
			});
		</script>
		
		<input type="text" name="search" id="search-messages" placeholder="search people" />
	<div class="message-senders" style="">

		@foreach($senders as $sender)
		<a href="{{route('messages.messages', ['senderId' => $sender->id])}}" target="ifr">
			<div id="user{{$sender->id}}" class="sender">
				<img src="{{ $sender->getAvatarUrl() }}" alt="{{ $sender->getNameOrUsername()}}" id="img">
				{{$sender->getFirstnameOrUsername()}}
			</div>
		</a>
		@endforeach
	</div>	
	<div class="messages"> 
		<iframe  name="ifr" frameborder="0" scrolling="yes" id="ifr">
	<div>

@endsection