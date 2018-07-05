<?php

namespace CollegeSocial\models;

use Illuminate\Database\Eloquent\Model;

class sender extends Model
{
    protected $table = 'senders';

    protected $fillable = [
		 'sender',
		 'user_id',
	];

	public function status()
	{
		return $this->belongsTo('CollegeSocial\models\user', 'user_id');
	}
}
