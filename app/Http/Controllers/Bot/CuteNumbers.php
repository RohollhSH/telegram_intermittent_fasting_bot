<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CuteNumbers extends Controller
{
    public static function change($input)
    {
        $numbers = ['1','2','3','4','5','6','7','8','9','0'];
        $cute_numbers = ['1️⃣','2️⃣','3️⃣','4️⃣','5️⃣','6️⃣','7️⃣','8️⃣','9️⃣','0️⃣'];
        return str_replace($numbers,$cute_numbers,$input);
    }
}
