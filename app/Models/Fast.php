<?php

namespace App\Models;


use App\Http\Controllers\Bot\InputController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Telegram;

class Fast extends Model
{
    const PROCESS = 'in_process';
    const ENDED = 'ended';

    public static function usersAllFast()
    {
        $time_array = self::select('break_fast_time', 'start_time')
                          ->where('user_id', InputController::$updates->message->from->id)->get();
        foreach ($time_array as $time) {
            if ($time->break_fast_time) {
                $fast_array[$time->start_time] = $time->break_fast_time - $time->start_time;
            }else{
                continue;
            }
        }
//        dd($time);
        return $fast_array;
    }
//    InputController::$updates->message->from->id
}