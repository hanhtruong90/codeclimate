<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protetected $guarded = [];

    protetected $casts = [
    	'schedules' => 'array'
    ]


    public function event(){
    	$this->belongsTo('App\Event', 'event');
    }



}
