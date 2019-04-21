<?php

namespace App\Http\Controllers\Bot\step_route;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\text_route\textRouteControllers\errorTextNotDefined;
use App\Http\Controllers\Bot\UserController;
use App\Http\Controllers\Controller;

class StepRouteQuery extends Controller
{
    private static $texts;
    public static function stepRouteDispatcher()
    {
        $step        = UserController::getStep(InputController::$updates->callback_query->from->id);
        self::$texts = [
            'start'           => 'StartStep',
            'settings'        => 'SettingsStep',
            'update_location' => 'UpdateLocation',
            'start_fast'      => 'StartFast',
        ];
        if (array_key_exists($step, self::$texts)) {
            $class = self::$texts[$step];
            $class = __NAMESPACE__ . '\\' . "stepRouteControllers\\" . $class;
            $class::run();
        } else {
            errorTextNotDefined::stepError(InputController::$updates->callback_query->from->id);
        }
    }
}
