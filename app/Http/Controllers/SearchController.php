<?php

namespace CollegeSocial\Http\Controllers;

use DB;
use CollegeSocial\Models\User;
use CollegeSocial\Models\worked;
use Illuminate\Http\Request;

class SearchController extends Controller
{
	public function getResult(Request $request)
	{
		$query = $request->input('query');
		if(!$query){
			return back();
		}

		$users = User::where(DB::raw("CONCAT(first_name, ' ', middle_name , ' ', last_name, ' ', branch, ' ', year)"), 'LIKE', "%{$query}%")
			->orWhere('username', 'LIKE', "%{$query}%")
			->orWhere(DB::raw("CONCAT(branch, ' ', year)"), 'LIKE', "%{$query}%")
			->orWhere(DB::raw("CONCAT(year, ' ', branch)"), 'LIKE', "%{$query}%")
			->orWhere(DB::raw("CONCAT(first_name, ' ',year, ' ', branch)"), 'LIKE', "%{$query}%")
			->orWhere(DB::raw("CONCAT(last_name, ' ', branch, ' ', year)"), 'LIKE', "%{$query}%")
			->orWhere(DB::raw("CONCAT(course, ' ', year, ' ', branch)"), 'LIKE', "%{$query}%")
			->orWhere(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
			->get();
		

		return view('search.results')->with('users', $users);
	}
}