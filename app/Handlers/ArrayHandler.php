<?php

namespace App\Handlers;

class ArrayHandler{

    public static function validateNumeric(array $array){
        foreach ($array as $key => $a) {
            if(!is_nan($a)){  return false; }
            return true;
        }
    }

    public static function cast(string $array){
        $decoded = json_decode($array);
        if(!is_array($decoded)){ return false; } 
        return true;
    }

}