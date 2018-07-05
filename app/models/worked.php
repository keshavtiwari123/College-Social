<?php

namespace CollegeSocial\models;

use Illuminate\Database\Eloquent\Model;

class worked extends Model
{
    protected $table = 'worked';

    protected $fillable = [
		 'user_id',
		 'worked',
		 'from',
		 'to',
	];

	public function user()
	{
		return $this->belongsTo('CollegeSocial\models\user', 'user_id');
	}
}
