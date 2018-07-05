<?php

namespace CollegeSocial\models;

use Illuminate\Database\Eloquent\Model;

class lived extends Model
{
    protected $table = 'lived';

    protected $fillable = [
		 'user_id',
		 'lived',
		 'from',
		 'to',
	];

	public function user()
	{
		return $this->belongsTo('CollegeSocial\models\user', 'user_id');
	}
}
