<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,  maximum-scale=1.0, minimum-scale=1.0">
	<title>College Social</title>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Handlee|Love+Ya+Like+A+Sister|Tillana">
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.3.3.5.min.css') }}" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/status.css')}}">
	<script type="text/javascript" src="{{ URL::asset('js/status_image.js') }}"></script> 
	<script type="text/javascript" src="{{ URL::asset('js/fileNameAndSize.js') }}"></script> 
</head>
<body>
@include('templates.partials.if-mobile')
	@if(mobile())
		@include('templates.partials.navigation_mobile')
		<link rel="stylesheet" href="{{ URL::asset('css/status_image_mobile.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/status_mobile.css') }}" />
	@else
		@include('templates.partials.navigation')
		<link rel="stylesheet" href="{{ URL::asset('css/status_image.css') }}" />
	@endif


	
	<div class="container">
		
		@include('templates.partials.alert')
		@yield('content')
	</div>
	
	<div id="space_in_mobile"></div>


	<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap3.3.5.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/search_mobile.js') }}"></script>
	@yield('script')	
<script type="text/javascript" src="{{ URL::asset('js/likes.js') }}"></script>
</body>
</html>