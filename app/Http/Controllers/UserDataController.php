<?php

namespace CollegeSocial\Http\Controllers;

use Auth;
use CollegeSocial\models\worked;
use CollegeSocial\models\lived;
use CollegeSocial\models\education;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function addWork(Request $request)
    {
    	Auth::user()->worked()->create([
			'from' => $request->input('from'),
			'to' => $request->input('to'),
			'worked' => $request->input('worked'),
		]);
		return redirect()->back();
    }

    public function deleteWork($workId)
    {
    	$work = Worked::find($workId);
    	if(Auth::user()->id == $work->user->id){
    		$work->delete();
    		return redirect()->back();
    	}
    	return redirect()->route('home')->with('info', "can`t do that");
    }

    public function editWork(Request $request, $workId)
    {
    	$work = Worked::find($workId);
    	if(Auth::user()->id == $work->user->id){
    		$work->update([
    			'from' => $request->input('from'),
				'to' => $request->input('to'),
				'worked' => $request->input('worked'),
    		]);
    		return redirect()->back();
    	}
    	return redirect()->route('home')->with('info', "can`t do that");	
    }


    public function addEducation(Request $request)
    {
    	Auth::user()->education()->create([
			'from' => $request->input('from'),
			'to' => $request->input('to'),
			'education' => $request->input('education'),
		]);
		return redirect()->back();
    }

    public function deleteEducation($educationId)
    {
    	$education = education::find($educationId);
    	if(Auth::user()->id == $education->user->id){
    		$education->delete();
    		return redirect()->back();
    	}
    	return redirect()->route('home')->with('info', "can`t do that");
    }

    public function editEducation(Request $request, $educationId)
    {
    	$education = education::find($educationId);
    	if(Auth::user()->id == $education->user->id){
    		$education->update([
    			'from' => $request->input('from'),
				'to' => $request->input('to'),
				'education' => $request->input('education'),
    		]);
    		return redirect()->back();
    	}
    	return redirect()->route('home')->with('info', "can`t do that");	
    }

    public function addLived(Request $request)
    {
    	Auth::user()->lived()->create([
			'from' => $request->input('from'),
			'to' => $request->input('to'),
			'lived' => $request->input('lived'),
		]);
		return redirect()->back();
    }

    public function deleteLived($livedId)
    {
    	$lived = lived::find($livedId);
    	if(Auth::user()->id == $lived->user->id){
    		$lived->delete();
    		return redirect()->back();
    	}
    	return redirect()->route('home')->with('info', "can`t do that");
    }

    public function editLived(Request $request, $livedId)
    {
    	$lived = lived::find($livedId);
    	if(Auth::user()->id == $lived->user->id){
    		$work->update([
    			'from' => $request->input('from'),
				'to' => $request->input('to'),
				'lived' => $request->input('lived'),
    		]);
    		return redirect()->back();
    	}
    	return redirect()->route('home')->with('info', "can`t do that");	
    }

}
