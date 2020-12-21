<?php

namespace App\Traits;
use Illuminate\Support\Facades\Log;
trait DeleteModelTraits {

    public function deleteModelTraits($id,$model) {
        try {
            $model->find($id)->delete();
            return response()->json([
             'code' => 200,
             'message' => 'success'
         ],200);
 
         } catch (\Throwable $th) {
             Log::error('Message:'.$th->getMessage().'  Line : ' . $th->getLine());
             return response()->json([
                 'code' => 500,
                 'message' => 'fail'
             ],500);
         }
    }









}