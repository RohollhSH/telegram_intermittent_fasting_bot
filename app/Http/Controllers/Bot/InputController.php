<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Bot\step_route\stepRoute;
use App\Models\BotInputMessage;
use App\Models\Fast;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Telegram;

class InputController extends Controller
{
    public $data;
    public static $updates;

    public function index()
    {
        self::$updates = json_decode(Telegram::commandsHandler(true));
        file_put_contents('updates.txt', json_encode(self::$updates) . PHP_EOL . PHP_EOL, FILE_APPEND);
        MainKeyboardController::showWelcome();
        UserController::updateStep('start');
//        $this->check();
    }


    public function check()
    {
        $input               = new BotInputMessage();
        $input->update_id    = self::$updates->update_id;
        $input->message_id   = self::$updates->message->message_id;
        $input->user_id      = self::$updates->message->from->id;
        $input->date_sent_at = Carbon::createFromTimestamp(self::$updates->message->date)->toDateTimeString();
        $input->json_input   = json_encode(self::$updates);
        $input->save();
        if (User::where('telegram_user_id', self::$updates->message->from->id)->first() == null) {
            file_put_contents('test.txt',json_decode(self::$updates->message->from->id).PHP_EOL.PHP_EOL,FILE_APPEND);
            MainKeyboardController::showWelcome();
            UserController::create();
            $response = Telegram::sendMessage([
                'chat_id' => self::$updates->message->from->id,
                'text'    => 'Its Your First Time Using This Bot' .
                             PHP_EOL .
                             'WELCOME'
            ]);
            $response = Telegram::sendMessage([
                'chat_id' => 138727887,
                'text'    => 'new user'
            ]);
        } else {
            StepRoute::stepRouteDispatcher();
        }
    }

    public static function test()
    {
        Fast::usersAllFast();
    }
}
