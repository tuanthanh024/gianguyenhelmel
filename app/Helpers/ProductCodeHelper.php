<?php

namespace App\Helpers;

class ProductCodeHelper
{
    public static function generateCode()
    {   
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomChars = '';
        for ($i = 0; $i < 2; $i++) {
            $randomChars .= $characters[rand(0, strlen($characters) - 1)];
        }
        $time = date('His');
        $code = $randomChars . $time;
        return $code;
    }
}
