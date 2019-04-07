<?php

namespace App\Http\Controllers\Bot;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram;

class MainKeyboardController extends Controller
{
    public static function showMainKeys($text)
    {
        $user_status = User::select('status')
                           ->where('telegram_user_id', InputController::$updates->message->from->id)
                           ->first();
        if ($user_status['status'] == 'chilling') {
            $keyboard = [
                [' ⏱Start Fast', ' 📊Stats'],
                ['🗞 Article', ' ⚙️Settings']
            ];
        } elseif ($user_status['status'] == 'fasting') {
            $keyboard = [
                [' ⏱ Remaining Time', ' 📊Stats'],
                ['🗞 Article', ' ⚙️Settings', 'End Fast']
            ];
        }
        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);

        $response = Telegram::sendMessage([
            'chat_id'      => InputController::$updates->message->from->id,
            'text'         => $text,
            'reply_markup' => $reply_markup
        ]);

        $messageId = $response->getMessageId();
    }

    public static function showWelcome()
    {
        $keyboard = [
            [' ⏱Start Fast', ' 📊Stats', ' ⚙️Settings'],
            ['🗞 Article', 'ℹ️ About']
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);
        $response     = Telegram::sendMessage([
            'chat_id'      => InputController::$updates->message->from->id,
            'text'         => 'Welcome its Your first time here',
            'reply_markup' => $reply_markup
        ]);
    }

    public static function showUserName(InputController $updates)
    {
        $keyboard = [
            [' ⏱Start Fast', ' 📊Stats', ' ⚙️Settings'],
            ['🗞 Article', 'ℹ️ About']
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);
        $response     = Telegram::sendMessage([
            'chat_id'      => $updates->message->from->id,
            'text'         => 'user_saved',
            'reply_markup' => $reply_markup
        ]);

        $messageId = $response->getMessageId();
    }

    public static function goBack($text)
    {
        $keyboard     = [
            ['Back to main menu 🔙'],
        ];
        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);
        $response     = Telegram::sendMessage([
            'chat_id'      => InputController::$updates->message->from->id,
            'text'         => $text,
            'reply_markup' => $reply_markup
        ]);
    }

    public static function backMainMenu()
    {
        $keyboard     = [
            [' ⏱Start Fast', ' 📊Stats', ' ⚙️Settings'],
            ['🗞 Article', 'ℹ️ About']
        ];
        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);
        $response     = Telegram::sendMessage([
            'chat_id'      => InputController::$updates->message->from->id,
            'text'         => 'Main menu :',
            'reply_markup' => $reply_markup
        ]);
    }

    public static function askForUpdateLocation()
    {
        $response = Telegram::sendMessage([
            'chat_id' => InputController::$updates->message->from->id,
            'text'    => 'send me your country name in English',
        ]);
    }

    public static function updatedLocation()
    {
        self::backMainMenu();
        $response = Telegram::sendMessage([
            'chat_id' => InputController::$updates->message->from->id,
            'text'    => 'Location updated',
        ]);
    }

    public static function error()
    {
        $response = Telegram::sendMessage([
            'chat_id' => InputController::$updates->message->from->id,
            'text'    => 'Error',
        ]);
    }

    public static function ok()
    {
        $response = Telegram::sendMessage([
            'chat_id' => InputController::$updates->message->from->id,
            'text'    => 'OK',
        ]);
    }

    public static function showSettings()
    {
//        $reply_markup = Telegram::forceReply();

/*        Keyboard::make()->inline()->row(Keyboard::inlineButton([
            'text'          => 'text',
            'callback_data' => 'data',
        ]));*/

        $keyboard        = [
            ['Set Country and Location 📍'],
            ['Back to main menu 🔙'],
        ];
        $reply_markup    = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);
/*        $inline_keyboard = Telegram::inlineButton([
            'text'          => 'text',
            'callback_data' => 'callback_data'
        ]);*/
        $response        = Telegram::sendMessage([
            'chat_id'         => InputController::$updates->message->from->id,
            'text'            => 'Settings.',
//            'inline_keyboard' => $inline_keyboard,
            'reply_markup' => $reply_markup
        ]);
    }

    /*Keyboard::make()->inline()->row(Keyboard::inlineButton([
    ‘text’          => ‘text’,
    ‘callback_data’ => ‘data’,
    ])*/
}
