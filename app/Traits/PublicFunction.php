<?php

namespace App\Traits;


trait PublicFunction
{
    public  $arrLabel= [];
    public  $arrMessage= [];





    public function getColNameForValidation($cols){
        $final_array = [];
        foreach ($cols as $key => $value){
            $final_array[$key]=isset($value[0])?$value[0]:'';
        }

        return $final_array;
    }
}