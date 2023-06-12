<?php

namespace App\Helpers;

class Helper {

    public static function formatFloatNumber($value, $decimals = 2)
    {

        $cleanValue = preg_replace('/\D/', '', $value);
        $newValue = substr_replace($cleanValue, '.', $decimals, 0);

        return $newValue;
    }

}