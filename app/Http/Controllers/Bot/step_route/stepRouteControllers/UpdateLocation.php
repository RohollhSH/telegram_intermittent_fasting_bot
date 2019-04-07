<?php

namespace App\Http\Controllers\Bot\step_route\stepRouteControllers;

use App\Http\Controllers\Bot\InputController;
use App\Http\Controllers\Bot\MainKeyboardController;
use App\Http\Controllers\Bot\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram;

class UpdateLocation extends Controller
{
    public static function run()
    {
        UserController::updateLocation();
        file_put_contents('test.txt', json_encode("works after updating location") . PHP_EOL . PHP_EOL, FILE_APPEND);
        UserController::updateStep('start');
        MainKeyboardController::showMainKeys('updated');
    }
}