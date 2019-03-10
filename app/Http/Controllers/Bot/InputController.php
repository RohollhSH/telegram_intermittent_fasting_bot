<?php

namespace App\Http\Controllers\Bot;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram;

class InputController extends Controller
{
    public $data;
    public static $updates;

    public function index()
    {
        self::$updates = json_decode(Telegram::commandsHandler(true));
        // Commands handler method returns an Update object.
        // So you can further process $update object
        // to however you want.
        file_put_contents('updates.txt', json_encode(self::$updates) . PHP_EOL . PHP_EOL, FILE_APPEND);
        MainKeyboardController::showMainKeys();
        $this->check();

        return 'ok';
    }

    public function check()
    {
//        $user = User::where('id', self::$updates->message->from->id)->first();
        if (User::where('id', '=', self::$updates->message->from->id)->first() === null) {
            $this->create();
        } else {
            return 'ok';
        }
    }

    public function create()
    {
        $user                   = new User();
        $user->telegram_user_id = self::$updates->message->from->id;
        $user->first_name       = self::$updates->message->from->first_name;
        $user->last_name        = self::$updates->message->from->last_name;
        $user->user_name        = self::$updates->message->from->username;
        $user->language_code    = self::$updates->message->from->language_code;
        $user->is_bot           = self::$updates->message->from->is_bot;
        $user->pay_amount       = 0;
        $user->invite_score     = 0;
        $user->was_invited      = 0;
        $user->channel          = 1;
        $user->country          = null;
        $user->remember_token   = bcrypt(self::$updates->message->from->id);
        $user->user_step        = "start";
        $user->save();
    }
}
