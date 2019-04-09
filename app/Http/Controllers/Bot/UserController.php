<?php

namespace App\Http\Controllers\Bot;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram\Bot\Laravel\Facades\Telegram;

class UserController extends Controller
{
    public static function create()
    {
        $user                   = new User();
        $user->telegram_user_id = InputController::$updates->message->from->id;
        $user->first_name       = InputController::$updates->message->from->first_name;
        if (isset(InputController::$updates->message->from->last_name)){
            $user->last_name        = InputController::$updates->message->from->last_name;
        }
        if (isset(InputController::$updates->message->from->username)){
            $user->user_name        = InputController::$updates->message->from->username;
        }
        if (isset(InputController::$updates->message->from->language_code)) {
            $user->language_code = InputController::$updates->message->from->language_code;
        }
        $user->is_bot           = InputController::$updates->message->from->is_bot;
        $user->pay_amount       = 0;
        $user->invite_score     = 0;
        $user->was_invited      = 0;
        $user->channel          = 1;
        $user->country          = null;
        $user->remember_token   = bcrypt(InputController::$updates->message->from->id);
        $user->user_step        = "start";
        $user->save();
    }

    public static function delete($user_id)
    {
        $user         = User::find($user_id);
        $deleteResult = $user->delete();
        if ($deleteResult) {
            return "ok";
        }
    }

    public static function edit($telegram_user_id)
    {
        $user = User::where('telegram_user_id', $telegram_user_id);
    }

    public static function updateLocation()
    {
        $user = new User();
        $user = User::where('telegram_user_id', InputController::$updates->message->from->id)
                    ->update([
                        'country' => InputController::$updates->message->text
                    ]);
    }

    public static function updateStep($user_step)
    {
        $user = User::where('telegram_user_id',
            InputController::$updates->message->from->id)->update(['user_step' => $user_step]);
    }

    public static function getStep()
    {
        $user_step = User::where('telegram_user_id',
            InputController::$updates->message->from->id)->get()->pluck('user_step')->toArray();

        return $user_step[0];
    }
}
