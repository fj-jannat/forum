<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	protected $guarded = [];
	
	/**
	 * A reply has a specific owner
	 * 
	 */
    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
