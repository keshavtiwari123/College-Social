<link rel="stylesheet" href="{{URL::asset('css/navbar_mobile.css')}}">
@if(Auth::check())
  <div class="icon-bar">
    <a href="{{route('home')}}"><i class="fa fa-home"></i></a>
    <a disabled="" id="search-btn"><i class="fa fa-search"></i></a> 
    <a href="{{route('messages.desktop')}}"><i class="fa fa-envelope-o"></i></a> 
    <a href="{{ route('profile.index', ['username' => Auth::user()->username])}}"><i class="fa fa-user"></i></a>
    <a href="{{route('friends.index')}}"><i class="fa fa-users"></i></a>
    <a href="{{route('profile.edit')}}"><i class="fa fa-cog fa-fw"></i></a>  
  </div>
  <div id='search' hidden="">
    <form action="{{ route('search.results')}}" role="search">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
      <input type="text" name="query" class="form-control" placeholder="Find People" minlength="3"/>
    </form>
  </div>
@endif