<?php

namespace CollegeSocial\Http\Controllers;

use Auth;
use Image;
use CollegeSocial\models\User;
use Illuminate\Http\Request;
use CollegeSocial\models\Status;

class ProfileController extends Controller
{
	public function getProfile($username)
	{
		$user = User::where('username', $username)->first();
		if(!$user){
			abort(404);
		}

		$statuses = $user->statuses()->notReply()->orderBy('created_at', 'desc')->paginate(10);

		return view('profile.index')
		->with('user', $user)
		->with('statuses', $statuses)
		->with('authUserIsFriend', Auth::user()->IsFriendsWith($user));

	}

	public function getEdit()
	{
		return view('profile.edit');
	}

	public function postEdit(Request $request)
	{
		$this->validate($request, [
			'first_name' => 'alpha|max:20',
			'last_name' => 'alpha|max:20',
			'location' => 'max:50',
			'hometown' => 'max:50',
			'year' => 'numeric',
			'work' => 'max:100',
			'course' => 'max:50'

		]);

		Auth::user()->update([
				'first_name' => $request->input('first_name'),
				'last_name' => $request->input('last_name'),
				'location' => $request->input('location'),
				'branch' => $request->input('branch'),
				'hometown' => $request->input('hometown'),
				'year' => $request->input('year'),
				'work' => $request->input('work'),
				'middle_name' => $request->input('middle_name'),
				'course' => $request->input('course'),
		]);

		return redirect()->route('profile.edit')->with('info', 'your profile has been updated');
	}

	public function postEditImage(Request $request)
	{
		$this->validate($request, [
			'profile' => 'max:4000'
		]);
		$filename = NULL;
		if($request->hasFile('profile'))
		{
			$profile = $request->file('profile');
			$profile->store('public/images/'.Auth::user()->username . '/profile');
			$filename = $profile->hashName();

			$input['imagename'] = 'thumb'.'.'.$filename;
			$destinationPath = public_path('/storage/images/'.Auth::user()->username . '/profile');
        	$img = Image::make($profile->getRealPath());
        	$img->fit(100)->save($destinationPath.'/'.$input['imagename']);
		
		}

		Auth::user()->update([
				'profile' => $filename,
		]);

		return redirect()->route('profile.edit')->with('info', 'your profile picture has been updated');
	}

	public function getAbout($username)
	{
		$user = User::where('username', $username)->first();
		return view('profile.about')->with('user', $user);
	}
}