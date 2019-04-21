<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\UserController;
use DateTimeZone;
use App\Http\Controllers\Controller;
use Telegram;
use Telegram\Bot\Keyboard\Keyboard;

class AskUpdateLocation extends Controller
{

    public static function getContinents()
    {
        return [
            'Africa'     => DateTimeZone::AFRICA,
            'AMERICA'    => DateTimeZone::AMERICA,
            'ANTARCTICA' => DateTimeZone::ANTARCTICA,
            'ASIA'       => DateTimeZone::ASIA,
            'ATLANTIC'   => DateTimeZone::ATLANTIC,
            'AUSTRALIA'  => DateTimeZone::AUSTRALIA,
            'EUROPE'     => DateTimeZone::EUROPE,
            'INDIAN'     => DateTimeZone::INDIAN,
            'PACIFIC'    => DateTimeZone::PACIFIC,
        ];
    }

    public static function run()
    {
        UserController::updateStep(InputController::$updates->message->from->id, 'update_location');
        $keyboard = Keyboard::make()
                            ->inline();
        foreach (self::getContinents() as $key => $continent) {
            $keyboard->row(Keyboard::inlineButton([
                'text'          => $key,
                'callback_data' => $continent,
            ]));
        }
        $response = Telegram::sendMessage([
            'chat_id'      => InputController::$updates->message->from->id,
            'text'         => "chose a continent",
            'reply_markup' => $keyboard
        ]);
        $text     = 'This part just helps me with language and timing stuff' .
                    PHP_EOL .
                    "Its required for religious fasting" .
                    PHP_EOL .
                    "in other cases you dont have to set your location";
        MainKeyboardController::showSettings(InputController::$updates->message->from->id, $text);
    }
}
