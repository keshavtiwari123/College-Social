<?php

namespace CollegeSocial\models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
		 'user_id',
		 'education',
		 'from',
		 'to',
	];

	public function user()
	{
		return $this->belongsTo('CollegeSocial\models\user', 'user_id');
	}
}
