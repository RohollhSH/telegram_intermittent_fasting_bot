<?php

namespace App\Http\Controllers\Bot\step_route\stepRouteControllers;

use App\Http\Controllers\Bot\text_route\StartText;
use App\Http\Controllers\Controller;

class StartStep extends Controller
{
    public static function run()
    {
        StartText::StartTextDispatcher();
    }
}