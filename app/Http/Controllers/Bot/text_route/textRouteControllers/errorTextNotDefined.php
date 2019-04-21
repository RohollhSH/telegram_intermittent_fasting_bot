<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\UserController;
use App\Http\Controllers\Controller;
use Telegram;

class errorTextNotDefined extends Controller
{
    public static function run()
    {
        UserController::updateStep(InputController::$updates->message->from->id,'start');
        MainKeyboardController::showMainKeys(InputController::$updates->message->from->id,'input not found');
    }

    public static function stepError($id)
    {
        MainKeyboardController::showSettings($id,'step not found');
    }
}
