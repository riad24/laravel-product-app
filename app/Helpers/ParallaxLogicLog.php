<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class ParallaxLogicLog
{
    public static function product()
    {
        return Log::channel('product-log');
    }
}
