<?php

namespace App\Http\Controllers\Bot\text_route;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\text_route\textRouteControllers\errorTextNotDefined;
use App\Http\Controllers\Controller;

class SettingsText extends Controller
{
    private static $texts;

    public static function TextDispatcher()
    {
        $text        = InputController::$updates->message->text;
        self::$texts = [
            'Set Country or Location' => 'AskUpdateLocation',
            'Back to main menu 🔙'        => 'BackMainMenu'
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