<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram;

class MainKeyboardController extends Controller
{
    public static function showMainKeys()
    {
        $keyboard = [
            [' ⏱Start Fast',' 📊Stats',' ⚙️Settings'],
            ['🗞 Article','ℹ️ About']
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);

        $response = Telegram::sendMessage([
            'chat_id'      => InputController::$updates->message->from->id,
            'text'         => 'I am working on project it wont be ready for at least a month thanks for checking. if you don\'t stop bot i can notify you when its ready 🌹',
            'reply_markup' => $reply_markup
        ]);

        $messageId = $response->getMessageId();
    }

    public static function showUserName(InputController $updates)
    {
        $keyboard = [
            [' ⏱Start Fast',' 📊Stats',' ⚙️Settings'],
            ['🗞 Article','ℹ️ About']
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);
        $response = Telegram::sendMessage([
            'chat_id'      => $updates->message->from->id,
            'text'         => 'user_saved',
            'reply_markup' => $reply_markup
        ]);

        $messageId = $response->getMessageId();
    }
}
