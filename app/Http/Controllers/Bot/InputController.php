<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram;

class InputController extends Controller
{
    public $data;

    public function index()
    {
//        $updates = Telegram::getWebhookUpdates();
//        file_put_contents('updates.txt',json_encode($updates).PHP_EOL.PHP_EOL,FILE_APPEND);
//        return 'ok';
        $updates = Telegram::commandsHandler(true);
        // Commands handler method returns an Update object.
        // So you can further process $update object
        // to however you want.
        file_put_contents('updates.txt',json_encode($updates).PHP_EOL.PHP_EOL,FILE_APPEND);
        MainKeyboardController::showMainKeys();
        return 'ok';
    }
}
