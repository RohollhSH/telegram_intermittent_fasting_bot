<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram;

class AskUpdateLocation extends Controller
{
    public static function run()
    {
        UserController::updateStep('update_location');
        $response = Telegram::sendMessage([
            'chat_id' => InputController::$updates->message->from->id,
            'text'    => 'Write your country name!',
        ]);
        MainKeyboardController::showSettings();
    }
}
