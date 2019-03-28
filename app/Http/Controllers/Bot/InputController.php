<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Bot\step_route\stepRoute;
use App\Http\Controllers\Bot\text_route\textRoute;
use App\Models\BotInputMessage;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Telegram;

class InputController extends Controller
{
    public $data;
    public static $updates;

    public function index()
    {
        self::$updates = json_decode(Telegram::commandsHandler(true));
        file_put_contents('updates.txt', json_encode(self::$updates) . PHP_EOL . PHP_EOL, FILE_APPEND);
//        MainKeyboardController::showSettings();
        $this->check();
        return 'ok';
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
            MainKeyboardController::showMainKeys();
            UserController::create();
            $response = Telegram::sendMessage([
                'chat_id' => self::$updates->message->from->id,
                'text'    => 'Its Your First Time Using This Bot' .
                             PHP_EOL .
                             'WELCOME'
            ]);
        } else {
            StepRoute::stepRouteDispatcher();
        }
    }

    public static function askForUpdateLocation()
    {
        $user = UserController::updateStep('update_location');
        MainKeyboardController::askForUpdateLocation();
        /*        if ($user){
                    MainKeyboardController::ok();
                }else{
                    MainKeyboardController::error();
                }*/
    }
}
