<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram;


class AskStartFast extends Controller
{
    public static function run()
    {
        UserController::updateStep(InputController::$updates->message->from->id,'start_fast');
        $text = 'How long You wanna fast ? 
send the hour and minute this way:
12:30';
        MainKeyboardController::goBack($text);
    }
}
