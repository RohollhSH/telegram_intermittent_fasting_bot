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
        file_put_contents('test.txt', "works" . PHP_EOL . PHP_EOL, FILE_APPEND);
        $response = Telegram::sendMessage([
            'chat_id' => InputController::$updates->message->from->id,
            'text'    => 'from setting input',
        ]);
        MainKeyboardController::showSettings();
    }
}
