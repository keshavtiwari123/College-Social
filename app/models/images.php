<?php

namespace CollegeSocial\models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';

    protected $fillable = [
		 'status_id',
		 'image',
	];

	public function status()
	{
		return $this->belongsTo('CollegeSocial\models\Status', 'status_id');
	}
}
