<?php

namespace CollegeSocial\Http\Controllers;

use Auth;
use DB;
use CollegeSocial\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
	public function getIndex()
	{
		$friends = Auth::user()->friends();
		$requests = Auth::user()->friendRequests();
		return view('friends.index')->with('friends', $friends)->with('requests', $requests);
	}

	public function getAdd($username)
	{
		$user = User::where('username', $username)->first();

		if(!$user){
			return redirect()->route('home')->with('info', 'the user could not be found');
		}

		if(Auth::user()->id === $user->id){
			return redirect()->route('home')->with('info', 'SO YOU WANT TO ADD YOURSELF AS A FRIEND, SORRY! THIS CAN`T BE DONE. IF YOU HAVE ANY SUGGESTIONS CONTACT keshav786tiwari@gmail.com ');
		}

		if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
			return redirect()->route('profile.index', ['username' => $user->username])->with('info', 'Friend request already pending');
		}

		if(Auth::user()->isFriendsWith($user)){
			return redirect()->route('profile.index', ['username' => $user->username])->with('info', 'You are already friends');
		}

		Auth::user()->addFriend($user);

		return redirect()->back()->with('info', 'Friend request sent');
	}

	public function getAccept($username)
	{
		$user = User::where('username', $username)->first();

		if(!$user){
			return redirect()->route('home')->with('info', 'the user could not be found');
		}

		if(!Auth::user()->hasFriendRequestReceived($user)){
			return redirect()->route('home');
		}

		Auth::user()->acceptFriendRequest($user);
		return redirect()->back()->with('info', 'Friend request accepted');
	}

	public function postDelete($username)
	{
		$user = User::where('username', $username)->first();

		if(!Auth::user()->isFriendsWith($user))
			{
				return redirect()->back();
			}

			Auth::user()->deleteFriend($user);

			return redirect()->back()->with('info', 'Friend Removed');
	}

	public function getfriends($username)
	{
		$user = User::where('username', $username)->first();
		return view('friends.friends')->with('user', $user);
	}

	public function getClassmates($username)
	{
		$user = User::where('username', $username)->first();
		$branch = $user->branch;
		$year = $user->year;
		$course = $user->course;
		$details = $course." ".$year." ".$branch;
		$classmates = User::where(DB::raw("CONCAT(course, ' ', year, ' ', branch)"), 'LIKE', "%{$details}%")->get();
		
		return view('friends.classmates')->with([
			'classmates' => $classmates,
			'user' => $user,
		]);
	}

	public function getBatchmates($username)
	{
		$user = User::where('username', $username)->first();
		$year = $user->year;
		$course = $user->course;
		$details = $course." ".$year;
		
		if($details != ' '){
			$batchmates = User::where(DB::raw("CONCAT(course, ' ', year)"), 'LIKE', "%{$details}%")->get();
		
			return view('friends.batchmates')->with([
			'batchmates' => $batchmates,
			'user' => $user,
		]);
		}
		if($user->id == Auth::user()->id){
			return redirect()->route('profile.edit')->with('info', 'We do not have information about your batchmates because You do not have updated your profile yet.Please let us know about your passing-out year and college you went');
		}
		else{
			return redirect()->back()->with('info', 'Sorry! no information as user has not updated his profile');
		}
	}

	public function getColleagues($username)
	{
		$user = User::where('username', $username)->first();
		$location = $user->location;
		$work = $user->work;
		$details = $location." ".$work;
		if($details != ' '){
		$colleagues = User::where(DB::raw("CONCAT(location, ' ', work)"), 'LIKE', "%{$details}%")->get();
		
		return view('friends.colleagues')->with([
			'colleagues' => $colleagues,
			'user' => $user,

		]);
		
	}
	if($user->id == Auth::user()->id){
		return redirect()->route('profile.edit')->with('info', 'We do not have information about your colleagues because You do not have updated your profile yet.Please let us know about your work and current city');
	}
	else{
		return redirect()->back()->with('info', 'Sorry! no information about as user has not updated his profile');
	}
	}
}