<?php

namespace App\Traits;
use Illuminate\Support\Str;
use Storage;
use Illuminate\Http\Request;
trait StorareImageTrait {

    public function storageTraitUpload($request,$fielName,$forderName) {
      
        if($request->hasFile($fielName)) {
            $file = $request->file($fielName);
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.'. $file->getClientOriginalExtension();
            $filepath = $request->file($fielName)->storeAs('public/'.$forderName.'/'.auth()->id(),$fileNameHash);
            
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filepath)
            ];
    
            return $dataUploadTrait;
        }

        return null;
       
    } 


    public function storageTraitUploadMultiple($file,$forderName) {
      
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.'. $file->getClientOriginalExtension();
            $filepath=$file->storeAs('public/'.$forderName.'/'.auth()->id(),$fileNameHash);
            
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filepath)
            ];
    
            return $dataUploadTrait;
        
       
    } 
}