<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>College Social</title>


<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.3.3.5.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/chats.css') }}">
</head>
<body>
	@include('templates.partials.navigation')
	<div class="container">
		
		@include('templates.partials.alert')
		<div class="col-lg-4 col-lg-offset-4">
			<h1 id="greeting">Hello! <span id="username">{{$username}}</span></h1>
			<div id="chat-window" class="col-lg-12">
				<div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
				<input type="text" id="text" name="text" class="form-control col-lg-12" autofocus="" onblur="notTyping()">
			</div>
		</div>
	</div>

	<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/chats.js') }}"></script>

</body>
</html>