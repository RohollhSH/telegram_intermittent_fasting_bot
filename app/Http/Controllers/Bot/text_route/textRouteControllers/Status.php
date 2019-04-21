<?php

namespace App\Http\Controllers\Bot\text_route\textRouteControllers;

use App\Http\Controllers\Bot\ChartDesigner;
use App\Http\Controllers\Bot\CuteNumbers;
use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Controller;
use App\Models\Fast;
use Illuminate\Support\Carbon;
use Telegram;
use Telegram\Bot\Keyboard\Keyboard;

class Status extends Controller
{
    public static function run()
    {
        self::SendFasts();
    }

    public static function SendFasts()
    {
        $fasts = Fast::usersAllFast();
        if ($fasts) {
            $response = Telegram::sendPhoto([
                'chat_id' => InputController::$updates->message->from->id,
                'photo'   => ChartDesigner::oneMonthFastChart(),
                'caption' => 'in past 30 days'
            ]);
            $i        = 1;
            $fasts    = array_reverse($fasts, true);
            foreach ($fasts as $date => $data_array) {
                $date     = Carbon::createFromTimestamp($date)->format('Y-M-d D h:i');
                $keyboard = Keyboard::make()
                                    ->inline()
                                    ->row(
                                        Keyboard::inlineButton([
                                            'text'          => 'remove this from database',
                                            'callback_data' => $data_array[1]
                                        ])
                                    );
                $response = Telegram::sendMessage([
                    'chat_id'      => InputController::$updates->message->from->id,
                    'text'         => CuteNumbers::change($i) . PHP_EOL . ' The Day You started Fast :' . PHP_EOL . $date
                                      . PHP_EOL
                                      . 'How long You Fasted ' . PHP_EOL . self::niceTimePrint($data_array[0]),
                    'reply_markup' => $keyboard
                ]);
                $i++;
            }
        } else {
            MainKeyboardController::showMainKeys(InputController::$updates->message->from->id,
                'error' .
                PHP_EOL .
                'no data to show' .
                PHP_EOL .
                'try Fasting first then come back to this section');
        }
    }

    public static function niceTimePrint($time)
    {
        $hour    = intval($time / 3600);
        $minutes = intval(($time % 3600) / 60);
        $seconds = $time - $hour * 3600 - $minutes * 60;
        $text    = "$hour : $minutes : $seconds";

        return $text;
    }
}
