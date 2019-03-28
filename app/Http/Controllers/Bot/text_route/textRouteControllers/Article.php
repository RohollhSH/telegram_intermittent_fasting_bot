<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\UserController;
use App\Http\Controllers\Controller;

class Article extends Controller
{
    public static function run()
    {
        UserController::updateStep('start');
        MainKeyboardController::showSettings();
    }
}