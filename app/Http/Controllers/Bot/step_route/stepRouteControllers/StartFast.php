<?php

namespace App\Http\Controllers\Bot\step_route\stepRouteControllers;

use App\Http\Controllers\Bot\CuteNumbers;
use App\Http\Controllers\Bot\FastController;
use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\text_route\textRouteControllers\errorTextNotDefined;
use App\Http\Controllers\Bot\UserController;
use App\Models\User;
use App\Http\Controllers\Controller;
use Telegram;

class StartFast extends Controller
{
    public static function run()
    {
        if (User::getStatus(InputController::$updates->message->from->id) == User::CHILLING) {
            User::updateStatus(User::FASTING);
            preg_match('/^(\d+):([0-5]?[0-9]|60)$/m', InputController::$updates->message->text, $time);
            if ($time) {
                $time_length = $time[1] * 3600 + $time[2] * 60;
                FastController::create($time_length);
                $time = FastController::remainTime();
                UserController::updateStep(InputController::$updates->message->from->id,'start');
                $text = self::niceTimePrint($time);
                MainKeyboardController::showMainKeys(InputController::$updates->message->from->id,$text);
            }else{
                User::where('telegram_user_id',InputController::$updates->message->from->id)
                    ->update([
                        'status' => User::CHILLING
                    ]);
                $response = Telegram::sendMessage([
                    'chat_id' => InputController::$updates->message->from->id,
                    'text'    => 'Wrong time
write it like 14:55',
                ]);
                errorTextNotDefined::run();
            }
        }elseif(User::getStatus(InputController::$updates->message->from->id) == User::FASTING){
            errorTextNotDefined::run();
        }
    }

    public static function niceTimePrint($time)
    {
        $hour = intval($time / 3600 );
        $minutes = intval(($time % 3600)/60);
        $seconds = $time - $hour*3600 -$minutes*60;
        $hour = CuteNumbers::change($hour);
        $minutes = CuteNumbers::change($minutes);
        $seconds = CuteNumbers::change($seconds);
        $text = "Started! Remaining time is  : 
$hour hours 
$minutes minutes 
$seconds seconds";
        return $text;
    }
}
