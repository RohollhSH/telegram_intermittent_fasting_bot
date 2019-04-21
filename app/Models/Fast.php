<?php

namespace App\Models;


use App\Http\Controllers\Bot\InputController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Telegram;

class Fast extends Model
{
    const PROCESS = 'in_process';
    const ENDED = 'ended';

    public static function usersAllFast()
    {
        $time_array = self::select('id', 'break_fast_time', 'start_time')
                          ->where('user_id', InputController::$updates->message->from->id)->get();
        if (isset($time_array[0])) {
            foreach ($time_array as $time) {
                if ($time->break_fast_time) {
                    $fast_array[$time->start_time] = [$time->break_fast_time - $time->start_time, $time->id];
                } else {
                    continue;
                }
            }

            return $fast_array;
        } else {
            return null;
        }
    }

    public static function UsersDaysFasts()
    {
        $time_array = self::select('break_fast_time', 'start_time')
                          ->where('user_id', InputController::$updates->message->from->id)->get();
        $fast_array=[];
        if (isset($time_array[0])) {
            foreach ($time_array as $time) {
                if ($time->break_fast_time) {
                    $fast_array[Carbon::createFromTimestamp($time->start_time)->format('M-d')] =
                        ($time->break_fast_time - $time->start_time)/3600;
                } else {
                    continue;
                }
            }

            return $fast_array;
        } else {
            return null;
        }
    }

    public static function removeFast()
    {
        return self::where('id', InputController::$updates->callback_query->data)->delete();
    }
//    InputController::$updates->message->from->id
}