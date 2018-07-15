<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/31/2018
 * Time: 11:55 AM
 */

namespace App\MyClass;


use Carbon\Carbon;

class Format
{
    public static function toMonetary($value)
    {

        $result = number_format($value, 2, '.', ',');
        if ($result == 0.00) {
            $result = "0.00";
        }

        return $result;
    }

    public static function toLongDate($value){
        return Carbon::parse($value)->format('F j, Y');
    }

    public static function toLongDateTime($time){
        return Carbon::parse($time)->format('F j, Y g:i a');
    }


}