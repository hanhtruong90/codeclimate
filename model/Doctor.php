<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    public  $table = 'doctors';

    public static $specialty = [
        'Read Book' => 'Read Book',
        'Listen music' => 'Listen music',
        'Play game' => 'Play game'

    ];

    public static $country = [
        'Viet Nam' => 'Viet Nam',
        'US' => 'US',
        'Russia' => 'Russia'

    ];

    public static $gender = ['Male' => 'Male','Female' => 'Female'];
    public static $smoker = ['No' => 'No','Social' => 'Social','Medium' => 'Medium','Heavy' => 'Heavy'];
    public static $drinker =  ['No' => 'No','Social' => 'Social','Medium' => 'Medium','Heavy' => 'Heavy'];
    public static $race = ['Black' => 'Black','White' => 'White','Yellow' => 'Yellow','Brown' => 'Brown'];
    public static $arrStatus = [0 =>'Inactive',1 => 'Active'];



    protected $fillable = [ 
        'firstname','familyname','email','status','specialty','country','clinic_name','mobile_number','verification_code'
    ];
    

    public static function generateCode($length = 5, $letters = '1234567890qwertyuiopasdfghjklzxcvbnm')
    {
        $s = '';
        $lettersLength = strlen($letters)-1; 

        for($i = 0 ; $i < $length ; $i++)
        {
            $s .= $letters[rand(0,$lettersLength)];
        }

        return strtoupper($s); 
    } 

    public static function checkVerificationCode($params) {
        $email = $params['email'];
        $code = $params['code'];
        $data = Doctor::where(['email' => $email, 'verification_code' => $code])->first();
        return $data;   
    } 

    public static function checkDoctorExist($id) {
        $check = Doctor::where(['id' => $id, 'status'=> 1])->first();
        return $check;  

    }

 
    public static function checkEmailExist($email) {
        $check = Doctor::where(['email' => $email, 'status'=> 1])->first();
        return $check;   

    }


    public static function generateListAge() {
        $arrAge = [];
        for( $i = 1; $i < 100; $i++) {
            $arrAge[] = $i;
        }
        return $arrAge; 
    }
     

}
