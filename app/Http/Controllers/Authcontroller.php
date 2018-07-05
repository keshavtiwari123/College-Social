<?php

namespace CollegeSocial\Http\Controllers;
use Auth;
use File;
use DB;
use CollegeSocial\models\user;
Use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function getSignup()
	{
		return view('auth.signup');
	}

	public function postSignup(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|unique:users|email|max:255',
			'username' => 'required|unique:users|alpha_dash|max:20',
			'password' => 'required|min:6',
		]);

		user::create([
			'email' => request()->input('email'),
			'username' => request()->input('username'),
			'password' => bcrypt(request()->input('password')),
		]);



			$path = public_path().'storage/images/'.request()->input('username').'/profile';
			$result = File::makeDirectory($path, $mode = 0777, true, true);


		if(!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))){

			return redirect()->back()->with('info', 'Can`t sign you in with these details');
		}
		return redirect()->route('home')->with('info', 'you are now signed in as '.request()->input('username'));

		//return redirect()->route('auth.signin')->with('info', 'Your account has been created and you can now sign in');
	}

	public function getSignin()
	{
		return view('auth.signin');
	}

	public function postSignin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required',
		]);

		if(!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))){
			return redirect()->back()->with('info', 'Can`t sign you in with these details');
		}
		return redirect()->route('home')->with('info', 'you are now signed in');
	}

	public function getSignout()
	{
		Auth::logout();

		return redirect()->route('home')->with('info', 'You have successfully logged out');
	}
}