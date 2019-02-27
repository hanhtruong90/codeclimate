<?php

namespace App;
use App\Doctor;
use App\Patient;
use App\BeforeAfterImage;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\HasMany;

class Submission extends Model
{
    //
    public  $table = 'submissions';

    public static $location= [
        "Upper Face" => "Upper Face", "Forehead" => "Forehead","Mid Face" => "Mid Face","Lower Face" => "Lower Face","Neck" =>"Neck"
    ];

    public static $treatmentarea = [
        "Forehead" => "Forehead","Glabella" => "Glabella","Eyebrow" =>"Eyebrow","Temple" => "Temple",
        "Cheekbones" => "Cheekbones","Malar" => "Malar","Bridge of Nose" => "Bridge of Nose",
        "Tip of nose & NL Angle" => "Tip of nose & NL Angle","Lateral Cheek" => "Lateral Cheek","Jawline & Upper Neck" => "Jawline & Upper Neck",
        "Nasolabial Fold" => "Nasolabial Fold",
        "Lips" => "Lips","Marionette Line" => "Marionette Line","Chin" => "Chin"
    ];

    public static $product= [
        "Ellanse" => "50ml",
        "Hilouette Soft" => "20ml",
        "Perfectha" => "30ml"
    ];

    public static $arrStatus = ['Approved' => 'Approved', 'Rejected' => 'Rejected','Awaiting Approval' => 'Awaiting Approval'];

    protected $fillable = [ 
        'doctor_id','patient_id','image_id','addition_infomation','treatment_used'
    ];
    protected $casts = [  
        'treatment_used' => 'array'
    ];
    
    public function doctor()
    {
        return $this->belongsTo(\App\Doctor::class, "doctor_id"); 
    }
 
    public function patient()
    {
        return $this->belongsTo(\App\Patient::class, "patient_id");
    }

    public function images()
    {
        return $this->belongsTo(\App\BeforeAfterImage::class,"image_id"); 
    }


 
    public static function getDetailSubmission($id) {
        $detail = Submission::find($id); 
        return $detail;
 
    }  


} 
