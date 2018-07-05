<?php

namespace CollegeSocial\Http\Controllers;

use Auth;
use CollegeSocial\models\user;
use CollegeSocial\models\Status;
use DB;
class HomeController extends Controller
{
	public function index()
	{
		if(Auth::check())
			{
				$user = Auth::user();
				$statuses = Status::notReply()->where(function($query)
				{
					return $query->where('user_id', Auth::user()->id)
					->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
				})->orderBy('created_at', 'desc')->paginate(10);
				return view('timeline.index')->with([
					'statuses' => $statuses,
					'user' => $user,
					
				]);
			}
		return view('auth.signin');
	}

	public function ajax(){
		return response()->json(['responce' => 'ajax is working']);
	}
}