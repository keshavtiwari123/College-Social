<?php

namespace CollegeSocial\models;

use Illuminate\Database\Eloquent\Model;

/**
* 
*/
class status extends Model
{
	
	protected $table = 'statuses';

	protected $fillable = [
		'body', 'user_id', 'img1', 'img2', 'img3', 'img4', 'img5',
	];

	public function user()
	{
		return	$this->belongsTo('CollegeSocial\models\user', 'user_id');
	}

	public function scopeNotReply($query)
	{
		return $query->whereNull('parent_id');
	}

	public function replies()
	{
		return $this->hasMany('CollegeSocial\models\Status', 'parent_id');
	}


	public function likes()
	{
		return $this->morphMany('CollegeSocial\models\like', 'likeable');
	}

	public function images()
    {
        return $this->hasMany('CollegeSocial\models\images', 'status_id');
    }


	
}