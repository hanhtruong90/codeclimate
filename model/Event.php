<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	
	protected $guarded = [];
	
    protected $table = 'events';

    protected $casts = [
    	'schedules' => 'object'
    ];
	
	// public function trainer(){
	// 	return $this->belongsToMany('App\User', 'events');
	// }
	
	public function trainer(){
        return $this->belongsTo(User::class);
	}

	public function schedules(){
		return $this->hasMany('App\Schedule');
	}
	
}
