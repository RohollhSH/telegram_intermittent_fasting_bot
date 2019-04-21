<?php

namespace App\Http\Controllers\Bot;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram;

class MainKeyboardController extends Controller
{
    public static function showMainKeys($id,$text)
    {
        $user_status = User::select('status')
                           ->where('telegram_user_id', $id)
                           ->first();
        if ($user_status['status'] == 'chilling') {
            $keyboard = [
                [' ⏱Start Fast', ' 📊Stats'],
                ['🗞 Article', ' ⚙️Settings']
            ];
        } elseif ($user_status['status'] == 'fasting') {
            $keyboard = [
                [' ⏱ Remaining Time', 'End Fast'],
                ['🗞 Article', ' ⚙️Settings', ' 📊Stats']
            ];
        }
        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);

        $response = Telegram::sendMessage([
            'chat_id'      => $id,
            'text'         => $text,
            'reply_markup' => $reply_markup
        ]);
    }

    public static function showWelcome($id)
    {
        $keyboard = [
            [' ⏱Start Fast', ' 📊Stats'],
            ['🗞 Article', ' ⚙️Settings']
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);
        $response     = Telegram::sendMessage([
            'chat_id'      => $id,
            'text'         => 'Welcome its Your first time here',
            'reply_markup' => $reply_markup
        ]);
    }

    public static function showUserName(InputController $updates)
    {
        $keyboard = [
            [' ⏱Start Fast', ' 📊Stats'],
            ['🗞 Article', ' ⚙️Settings']
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
            [' ⏱Start Fast', ' 📊Stats'],
            ['🗞 Article', ' ⚙️Settings']
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

    public static function showSettings($id,$text)
    {
        $keyboard        = [
            ['Set Country or Location'],
            ['Back to main menu 🔙'],
        ];
        $reply_markup    = Telegram::replyKeyboardMarkup([
            'keyboard'          => $keyboard,
            'resize_keyboard'   => true,
            'one_time_keyboard' => true
        ]);
        $response        = Telegram::sendMessage([
            'chat_id'         => $id,
            'text'            => $text,
            'reply_markup' => $reply_markup
        ]);
    }
}
