<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\UserController;
use App\Http\Controllers\Controller;

class Article extends Controller
{
    public static function run()
    {
        UserController::updateStep(InputController::$updates->message->from->id,'start');
        MainKeyboardController::showSettings(InputController::$updates->message->from->id,'This Section is empty for now');
    }
}