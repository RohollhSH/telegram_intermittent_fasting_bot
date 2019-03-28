<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StartFast extends Controller
{
    public static function run()
    {
        UserController::updateStep('start_fast');
        MainKeyboardController::showSettings();
    }
}
