<?php

namespace App\Http\Controllers\Bot\step_route;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\text_route\textRouteControllers\errorTextNotDefined;
use App\Http\Controllers\Bot\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SebastianBergmann\CodeCoverage\Report\PHP;

class StepRoute extends Controller
{
    private static $texts;

    /**
     * @return null
     */
    public static function stepRouteDispatcher()
    {
        $step        = UserController::getStep();
        file_put_contents('test.txt',json_encode($step).PHP_EOL.PHP_EOL,FILE_APPEND);
        self::$texts = [
            'start'    => 'startStep',
            'settings' => 'settingsStep',
        ];
        if (array_key_exists($step, self::$texts)) {
            file_put_contents('test.txt',json_encode("works").PHP_EOL.PHP_EOL,FILE_APPEND);
            $class = self::$texts[$step];
            $class = __NAMESPACE__ . '\\' . "stepRouteControllers\\" . $class;
            $class::run();
        } else {
            errorTextNotDefined::run();
        }
    }
}
