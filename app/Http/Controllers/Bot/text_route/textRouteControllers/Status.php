<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\CuteNumbers;
use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Controller;
use App\Models\Fast;
use Illuminate\Support\Carbon;
use Telegram;

class Status extends Controller
{
    public static function run()
    {
        self::SendFasts();
    }

    public static function SendFasts()
    {
        $fasts = Fast::usersAllFast();
        $i = 1;
        foreach ($fasts as $date => $length){
            $date = Carbon::createFromTimestamp($date)->format('Y-M-d D h:i');
            $response = Telegram::sendMessage([
                'chat_id' => InputController::$updates->message->from->id,
                'text'    => CuteNumbers::change($i).PHP_EOL.' The Day You started Fast :'.PHP_EOL.$date
                .PHP_EOL
                .'How long You Fasted '.PHP_EOL.self::niceTimePrint($length),
            ]);
            $i++;
        }
        MainKeyboardController::showMainKeys('');
    }

    public static function niceTimePrint($time)
    {
        $hour = intval($time / 3600 );
        $minutes = intval(($time % 3600)/60);
        $seconds = $time - $hour*3600 -$minutes*60;
        $text = "$hour : $minutes : $seconds";
        return $text;
    }
}
