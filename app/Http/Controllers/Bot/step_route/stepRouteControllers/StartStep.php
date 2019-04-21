<?php

namespace App\Http\Controllers\Bot\step_route\stepRouteControllers;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\text_route\StartText;
use App\Http\Controllers\Controller;
use App\Models\Fast;
use Telegram;

class StartStep extends Controller
{
    public static function run()
    {
        if (isset(InputController::$updates->message->text)) {
            StartText::StartTextDispatcher();
        } elseif (isset(InputController::$updates->callback_query->data)) {
            $result = Fast::removeFast();
            if ($result) {
                $response = Telegram::sendMessage([
                    'chat_id' => InputController::$updates->callback_query->from->id,
                    'text'    => 'has been deleted'
                ]);
            } else {
                $response = Telegram::sendMessage([
                    'chat_id' => InputController::$updates->callback_query->from->id,
                    'text'    => 'error' .
                                 PHP_EOL .
                                 "Make Sure its not already removed before"
                ]);
            }
        }
    }
}