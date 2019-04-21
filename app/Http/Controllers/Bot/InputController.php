<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Bot\step_route\stepRoute;
use App\Http\Controllers\Bot\step_route\StepRouteQuery;
use App\Models\BotInputMessage;
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
//        MainKeyboardController::showWelcome(138727887);
//        UserController::updateStep(138727887,'start');

//        MainKeyboardController::showWelcome(138727887);
//        UserController::updateStep(138727887,'start');
        $this->check();

        return 'ok';
    }


    public function check()
    {
        if (isset(self::$updates->message->text)) {
            $input               = new BotInputMessage();
            $input->update_id    = self::$updates->update_id;
            $input->message_id   = self::$updates->message->message_id;
            $input->user_id      = self::$updates->message->from->id;
            $input->date_sent_at = Carbon::createFromTimestamp(self::$updates->message->date)->toDateTimeString();
            $input->json_input   = json_encode(self::$updates);
            $input->save();
            if (User::where('telegram_user_id', self::$updates->message->from->id)->first() == null) {
                $response = Telegram::sendMessage([
                    'chat_id'                  => self::$updates->message->from->id,
                    'text'                     => 'bot is not completed yet' .
                                                  PHP_EOL .
                                                  'this bot is open source if you want to see the code you can check it out here' .
                                                  PHP_EOL .
                                                  'https://github.com/RohollhSH/telegram_intermittent_fasting_bot',
                    'disable_web_page_preview' => 'true'
                ]);
                file_put_contents('test.txt', json_encode(self::$updates->message->from->id) . PHP_EOL . PHP_EOL,
                    FILE_APPEND);
                MainKeyboardController::showWelcome(self::$updates->message->message_id);
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
        } elseif (isset(InputController::$updates->callback_query->data)) {
            StepRouteQuery::stepRouteDispatcher();
        }
    }
}