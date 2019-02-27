<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    public  $table = 'patients';
    protected $fillable = [ 
        'firstname','familyname','age','gender','smoker','drinker','race','consent_form'
    ];
    
}
