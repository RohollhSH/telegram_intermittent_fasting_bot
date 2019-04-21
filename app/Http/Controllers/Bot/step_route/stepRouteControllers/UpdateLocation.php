<?php

namespace App\Http\Controllers\Bot\step_route\stepRouteControllers;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\Timezones;
use App\Http\Controllers\Bot\UserController;
use App\Http\Controllers\Controller;
use Telegram;
use Telegram\Bot\Keyboard\Keyboard;

class UpdateLocation extends Controller
{
    public static function run()
    {

        if (isset(InputController::$updates->callback_query->data)) {
            if (in_array(InputController::$updates->callback_query->data,Timezones::Regions())) {
                $keyboard = Keyboard::make()
                                    ->inline();
                foreach (Timezones::getTimeZones(InputController::$updates->callback_query->data) as $key => $continent) {
                    $keyboard->row(Keyboard::inlineButton([
                        'text'          => $continent,
                        'callback_data' => $key,
                    ]));
                }
                Telegram::editMessageText([
                    'chat_id'      => intval(InputController::$updates->callback_query->message->chat->id),
                    'message_id'   => intval(InputController::$updates->callback_query->message->message_id),
                    'text'         => 'Select country or region',
                    'reply_markup' => $keyboard
                ]);
            } else {
                UserController::updateLocation(InputController::$updates->callback_query->from->id,
                    InputController::$updates->callback_query->data);
                MainKeyboardController::showMainKeys(InputController::$updates->callback_query->from->id,'Updated');
            }
        } else {
            UserController::updateStep(InputController::$updates->message->from->id, 'start');
            MainKeyboardController::showMainKeys(InputController::$updates->message->from->id,'wrong input');
        }
        //handle empty text
    }
}