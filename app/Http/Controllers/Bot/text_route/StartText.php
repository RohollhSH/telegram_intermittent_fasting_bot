<?php
/**
 * Created by PhpStorm.
 * User: Rohollah
 * Date: 03/27/2019
 * Time: 12:50 AM
 */

namespace App\Http\Controllers\Bot\text_route;


use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\text_route\textRouteControllers\errorTextNotDefined;
use App\Http\Controllers\Controller;
use Telegram;

class startText extends Controller
{
    private static $texts;

    /**
     * @return null
     */
    public static function StartTextDispatcher()
    {
        $text        = InputController::$updates->message->text;
        self::$texts = [
            '⚙️Settings'   => 'SettingInput',
            ' ⏱Start Fast' => 'StartFast',
            ' 📊Stats'     => 'Status',
            'ℹ️ About'     => 'About',
            '🗞 Article'   => 'Article'
        ];
        if (array_key_exists($text, self::$texts)) {
            $class = self::$texts[$text];
            $class = __NAMESPACE__ . '\\' . "textRouteControllers\\" . $class;
            $class::run();
        } else {
            errorTextNotDefined::run();
        }
    }
}