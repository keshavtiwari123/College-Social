<?php

namespace CollegeSocial\models;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $table = 'likeable';

    protected $fillable = [
		 'user_id'
	];

    public function likeable()
    {
    	return $this->morphTo();
    } 

    public function user()
	{
		return $this->belongsTo('CollegeSocial\models\user', 'user_id');
	}
}
