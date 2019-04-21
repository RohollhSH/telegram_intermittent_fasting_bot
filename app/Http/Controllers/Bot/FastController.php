<?php

namespace App\Http\Controllers\Bot;

use App\Models\Fast;
use App\Http\Controllers\Controller;

class FastController extends Controller
{
    public static function create($time_length)
    {
        $fast                   = new Fast();
        $fast->user_id          = InputController::$updates->message->from->id;
        $fast->start_time       = InputController::$updates->message->date;
        $fast->desired_end_time = $time_length;
        $fast->end_time         = InputController::$updates->message->date + $time_length;
        $fast->status           = Fast::PROCESS;
        $fast->save();
    }

    public static function endFast()
    {
        $last_fast = Fast::where('user_id', InputController::$updates->message->from->id)
                         ->where('status', Fast::PROCESS);
        $last_fast->update([
            'status'          => Fast::ENDED,
            'break_fast_time' => time(),
        ]);
    }

    public static function passedTime()
    {
        $end_time = Fast::select('start_time')
                        ->where('user_id', InputController::$updates->message->from->id)
                        ->orderBy('created_at', 'desc')->first();
        $now      = time();

        return ($now - $end_time['start_time']);
    }

    public static function remainTime()
    {
        $end_time = Fast::select('end_time')
                        ->where('user_id', InputController::$updates->message->from->id)
                        ->orderBy('created_at', 'desc')->first();
        $now      = time();

        return ($end_time['end_time'] - $now);
    }
}