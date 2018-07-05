<?php

namespace CollegeSocial\models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class messages extends Model
{
    protected $table = 'messages';

    protected $fillable = [
    	'body', 'user_id', 'sender_id'
    ];

    public function user()
	{
		return	$this->belongsTo('CollegeSocial\models\user', 'user_id');
	}

	public function sender()
	{
		$id = $this->sender_id;
		$user = User::where(DB::raw("CONCAT(id)"), 'LIKE', "%{$id}%")->get()->first();
		return $user;
	}

	public function sentTo()
	{

	}
}
