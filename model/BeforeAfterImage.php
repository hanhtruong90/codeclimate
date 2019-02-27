<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeforeAfterImage extends Model
{
    //
    public  $table = 'beforeafter_images';
    protected $fillable = [ 
        'before_left_profile','before_frontal','before_right_oblique','after_left_profile','after_frontal','after_right_oblique'
    ];

    
}
