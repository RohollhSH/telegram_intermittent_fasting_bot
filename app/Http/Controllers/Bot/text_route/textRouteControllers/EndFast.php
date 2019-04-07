<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\CuteNumbers;
use App\Http\Controllers\Bot\FastController;
use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\UserController;
use App\Models\User;
use App\Http\Controllers\Controller;

class EndFast extends Controller
{
    public static function run()
    {
        FastController::endFast();
        $time = FastController::passedTime();
        UserController::updateStep('start');
        $text = self::niceTimePrint($time);
        User::where('telegram_user_id',InputController::$updates->message->from->id)
            ->update([
                'status' => User::CHILLING
            ]);
        MainKeyboardController::showMainKeys($text);
    }

    public static function niceTimePrint($time)
    {
        $hour = intval($time / 3600 );
        $minutes = intval(($time % 3600)/60);
        $seconds = $time - $hour*3600 -$minutes*60;
        $hour = CuteNumbers::change($hour);
        $minutes = CuteNumbers::change($minutes);
        $seconds = CuteNumbers::change($seconds);
        $text = "You fasted for  : 
$hour hours 
$minutes minutes 
$seconds seconds";
        return $text;
    }
}
