<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    //
    public static function uploadFile($file, $folder='consent_form') {
        $filename = date('Ymd-His-') . $file->getFilename() . '.' . $file->extension();
        $filePath = 'uploads/';
        try{ 
            if(Storage::disk('public')->putFileAs($filePath, $file, $filename)) {
                return $filePath . $filename;
            }
            return false;
        }  
        catch (\Exception $e) {
            return false;
        } 
    }
}
