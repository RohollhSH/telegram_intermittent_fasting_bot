<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram;

class About extends Controller
{
    public static function run()
    {
        $response = Telegram::sendMessage([
            'chat_id' => InputController::$updates->message->from->id,
            'text'    => 'from setting input',
        ]);
        MainKeyboardController::showSettings(InputController::$updates->message->from->id,'no data for now');
    }
}