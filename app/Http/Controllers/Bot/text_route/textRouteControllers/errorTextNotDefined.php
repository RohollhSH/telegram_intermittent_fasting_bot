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
        UserController::updateStep('start');
        MainKeyboardController::showMainKeys('input not found');
    }

    public static function stepError()
    {
        file_put_contents('test.txt', "works" . PHP_EOL . PHP_EOL, FILE_APPEND);
        $response = Telegram::sendMessage([
            'chat_id' => InputController::$updates->message->from->id,
            'text'    => 'step not found',
        ]);
        MainKeyboardController::showSettings();
    }
}
