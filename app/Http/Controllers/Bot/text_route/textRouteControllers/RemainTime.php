<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\CuteNumbers;
use App\Http\Controllers\Bot\FastController;
use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Models\Fast;
use App\Models\User;
use App\Http\Controllers\Controller;

class RemainTime extends Controller
{
    public static function run()
    {
        $user_status = User::select('status')
                           ->where('telegram_user_id', InputController::$updates->message->from->id)
                           ->first();
        file_put_contents('test.txt', json_encode($user_status) . PHP_EOL . PHP_EOL, FILE_APPEND);
        if ($user_status['status'] == 'fasting') {
            $time = FastController::remainTime();
            $hour = intval($time / 3600 );
            $minutes = intval(($time % 3600)/60);
            $seconds = $time - $hour*3600 -$minutes*60;
            $hour = CuteNumbers::change($hour);
            $minutes = CuteNumbers::change($minutes);
            $seconds = CuteNumbers::change($seconds);
            $text = "Remaining time is  : 
$hour hours 
$minutes minutes 
$seconds seconds";
            MainKeyboardController::showMainKeys(InputController::$updates->message->from->id,$text);
        }else{
            errorTextNotDefined::run();
        }
    }
}
