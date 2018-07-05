<?php

namespace CollegeSocial\Http\Controllers;

use Auth;
use DB;
use CollegeSocial\models\user;
use CollegeSocial\models\messages;
use Illuminate\Http\Request;

class messageController extends Controller
{
    public function getIndexMobile()
    {
    	return view('timeline.friends-online-mobile');
    }

    public function getIndexDesktop()
    {
    	$msg_by_sndrs = messages::where('user_id', Auth::user()->id)->get();
        $msg_by_me = messages::where('sender_id', Auth::user()->id)->get();

    	$senders = user::whereIn('id', $msg_by_sndrs->pluck('sender_id'))->orWhereIn('id', $msg_by_me->pluck('user_id'))->get();
		return view('messages.home')->with([
			'senders' => $senders,
		]);
    }

    public function getMessagesDesktop($senderId)
    {
        
        $sender = user::where('id', $senderId)->get()->first();
        $messages = messages::where([
            'user_id' => $senderId,
            'sender_id' => Auth::user()->id 
        ])->orWhere([
            'user_id' => Auth::user()->id,
            'sender_id' => $senderId,
        ])->get();

        return view('messages.messages')->with([
            'sender' => $sender,
            'messages' => $messages,
        ]);
    }

    public function sendMessages(Request $request, $senderId)
    {
        $message = messages::create([
            'body' => $request->input('message'),
            'user_id' => $senderId,
            'sender_id' => Auth::user()->id,
        ]);
        $message->save();
    }
}
