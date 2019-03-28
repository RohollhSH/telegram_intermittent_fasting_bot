<?php

namespace App\Http\Controllers\Bot\step_route\stepRouteControllers;

use App\Http\Controllers\Bot\text_route\SettingsText;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsStep extends Controller
{
    public static function run()
    {
        SettingsText::run();
    }
}
