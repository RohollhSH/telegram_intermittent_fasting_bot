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
            [' ⏱Start Fast', ' 📊Stats', ' ⚙️Settings'],
            ['🗞 Article', 'ℹ️ About']
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);

        $response = Telegram::sendMessage([
            'chat_id'      => InputController::$updates->message->from->id,
            'text'         => 'Home',
            'reply_markup' => $reply_markup
        ]);

        $messageId = $response->getMessageId();
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

    public static function showSettings()
    {
        $keyboard     = [
            ['Set Country and Location 📍'],
            ['Back to main menu 🔙'],
        ];
        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);
        $response     = Telegram::sendMessage([
            'chat_id'      => InputController::$updates->message->from->id,
            'text'         => 'Settings.',
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

    /*Keyboard::make()->inline()->row(Keyboard::inlineButton([
    ‘text’          => ‘text’,
    ‘callback_data’ => ‘data’,
    ])*/
}
