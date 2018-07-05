@if(Auth::check())
	@if(Auth::user()->friends()->count())
		@include('timeline.friends-online')
	@endif
@endif	
<nav class="navbar navbar-default" role="navigation">
	<link rel="stylesheet" type="text/css" href={{URL::asset('css/navbar_desktop.css')}}>>
<div class="navigator">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ route('home')}}">College Social</a>
		</div>
		<div class="collapse navbar-collapse">
			@if (Auth::check())
			<ul class = "nav navbar-nav">
				<li><a href="{{route('home')}}"><i class="fa fa-home big"></i></a></li>
				<li><a href="{{route('friends.index')}}"><i class="fa fa-users big"></i></a></li>
			</ul>
			<form class="navbar-form navbar-left" role="search" action="{{ route('search.results')}} ">
				<div class="form-group">
					<input type="text" name="query" class="form-control" placeholder="Find People" minlength="3">
				</div>
				<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
			</form>
			@endif
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::Check()) 
					<li><a href="{{route('messages.desktop')}}"><i class="fa fa-envelope-o big"></i></a></li>
					<li><a href="{{ route('profile.index', ['username' => Auth::user()->username])}}"><img src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ Auth::user()->getNameOrUsername()}}" width="35%" style="border-radius: 500px; margin-top: -5px"></i><div> {{Auth::user()->getFirstNameOrUsername() }}</div></a></li>
					<li><a href="{{route('profile.edit')}}"><i class="fa fa-cog fa-fw big"></i></a></li>
					<li><a href="{{route('auth.signout') }}"><i class="fa fa-sign-out big"></i><div>Sign out</div></a></li>
				@endif
			</ul>
		</div>
	</div>
</div>
</nav>