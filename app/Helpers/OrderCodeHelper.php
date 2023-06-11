<?php

namespace App\Helpers;

use Carbon\Carbon;

class OrderCodeHelper
{
    public static function generateCode()
    {
        $date = Carbon::now()->format('ymd');
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        $time = date('his');
        return $date . $randomString . $time;
    }
}
