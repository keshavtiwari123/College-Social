<?php

namespace CollegeSocial\Http\Controllers;

use Auth;
use DB;
use Image;
use CollegeSocial\models\like;
use CollegeSocial\models\images;
use CollegeSocial\models\user;
use CollegeSocial\models\Status;
use Illuminate\Http\Request;


class StatusController extends Controller
{
	public function postStatus(Request $request)
	{
		$this->validate($request, [
			'status' =>'max:1000',
		]);  
		
		
		Auth::user()->statuses()->create([
			'body' => $request->input('status'),
		]); 

	$status = Auth::user()->statuses()->orderBy('id', 'desc')->first();
	if($request->hasFile('image'))
		{ 
			$username = Auth::user()->username;
			foreach($request->image as $image)
			{
				$image->store('public/images/'.$username);
				$filename = $image->hashName();
				if(!$image->isValid())
				{
					return redirect()->back()->with('info', 'can`t upload try after some time');
				}
				else
				{
					$status->images()->create([
						'image' => $filename,
					]);
				}

			}
		}
	
		

		return redirect()->route('home')->with('info', 'Status Uploaded');
	}

	public function postStatusEdit(Request $request, $statusId)
	{
		$this->validate($request, [
			'status' =>'required|max:1000',
		]);
		
		Auth::user()->statuses()->where('id', $statusId)->update([
			'body' => $request->input('status'),
		]);

		$status = Status::find($statusId);
		if($request->hasFile('image'))
		{ 
			$username = Auth::user()->username;
			foreach($request->image as $image)
			{
				$image->store('public/images/'.$username);
				$filename = $image->hashName();
				if(!$image->isValid())
				{
					return redirect()->back()->with('info', 'can`t upload try after some time');
				}
				else
				{
					$status->images()->create([
						'image' => $filename,
					]);
				}

			}
		}


		return redirect()->back()->with('info', 'Edited Successfully.');
	}

	public function postReply(Request $request, $statusId)
	{
		$this->validate($request, [
			"reply-{$statusId}" => 'required|max:1000',
		], [
			'required' => 'The reply should not be empty.'
		]);
		
		$status = Status::find($statusId);

		if(!$status)
		{
			return redirect()->route('home');
		}
		if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !==$status->user->id)
			{
				return redirect()->route('home');
			}

		

		$reply = Status::create([
			'body' => $request->input("reply-{$statusId}"),
			'user_id' => Auth::user()->id,
		]);

		$status->replies()->save($reply);
		if($request->hasFile('image'))
		{ 
			$username = Auth::user()->username;
			foreach($request->image as $image)
			{
				$image->store('public/images/'.$username);
				$filename = $image->hashName();
				if(!$image->isValid())
				{
					return redirect()->back()->with('info', 'can`t upload try after some time');
				}
				else
				{
					$reply->images()->create([
						'image' => $filename,
					]);
				}

			}
		}

		return redirect()->back();
	}

	public function getLike($statusId)
	{
		$status = Status::find($statusId);

		if(!$status)
		{
			return redirect()->route('home');
		}
		if(Auth::user()->hasLikedStatus($status))
			{
				$like = $status->likes()
				->where('user_id', Auth::user()->id)
				->delete();
				return redirect()->back();
			}
		$like = $status->likes()->create([
			'user_id' => Auth::user()->id,
		]);
		Auth::user()->likes()->save($like);

	
	}

	public function getLikeList($statusId)
	{
		$status = Status::find($statusId);
		return view('user.partials.likelist')->with('status', $status);
	}

	public function getComment($statusId)
	{
		$status = Status::find($statusId);
		return view('timeline.comment')->with('status', $status);
	}

	public function getDelete($statusId)
	{
		$status = Status::find($statusId);
		if(Auth::user()->id == $status->user->id){
			if(!$status->notReply){
				$status->delete();		
			}
			else{
				Auth::user()->statuses()
				->where('id', $statusId)
				->orWhere('parent_id', $statusId)
				->delete();
			}
			return redirect()->back()->with('info', 'Deleted permanently');
		}
		return redirect()->route('home');	
	}

	public function getDeleteImage($statusId, $imageId)
	{
		$status = Status::find($statusId);
		if(Auth::user()->id == $status->user->id){
			images::where(['id' => $imageId, 'status_id' => $statusId])->delete();	
			return redirect()->back()->with('info', 'Deleted permanently');
		}
		return redirect()->route('home');
			
	}

	public function getEdit($statusId)
	{
		$status = Status::find($statusId);
		if(Auth::user()->id == $status->user->id){
			return view('timeline.edit_status')->with(['status' => $status, 'info' => 'make sure that you have images in sequence']);
		}
		return redirect()->route('home');
	}
	
}