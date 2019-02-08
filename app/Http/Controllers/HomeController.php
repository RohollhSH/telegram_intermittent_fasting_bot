<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class HomeController extends Controller
{
    public function newUser()
    {
        Telegram::sendMessage([
            ''
        ]);
    }
}
