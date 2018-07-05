@extends('templates.default')

@section('content')
<h1>Sign in</h1>
	<div class="row">
		<div class="col-lg-6">
			<form class="form-vertical" role="form" method="post" action="{{route('auth.signin')}}">
				<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}} ">
					<label for="email" class="control-label" >Email address</label>
					<span class="form-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
					<input type="text" name="email" class="form-control" id="email" value="">
					@if( $errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
					
				</div>
				
				<div class="form-group{{ $errors->has('password') ? ' has-error' : ''}} ">
					<label for="password" class="control-label" >Password</label>
					<span class="form-group-addon"><i class="fa fa-key fa-fw"></i></span>
					<input type="password" name="password" class="form-control" id="password">
					
					@if( $errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="remember">Remember me
					</label>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Sign in</button>
				</div>
				{{ csrf_field() }}
			</form>
		</div>
	</div>
	<ul class="list-inline">
		<li><h4>Not yet Registered!</h4></li>
		<li><a class="btn btn-default" href="{{route('auth.signup')}}">Sign Up</a></li>
	</ul>

@endsection