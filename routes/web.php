<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




//$updates = url()->current();
//file_put_contents('updates.txt',json_encode($updates).PHP_EOL.PHP_EOL,FILE_APPEND);
//return 'ok';

Route::get('/', function () {
    return view('welcome');
});


/*Route::post('/', function () {
    $updates = Telegram::getWebhookUpdates();
    file_put_contents('updates.txt',json_encode($updates).PHP_EOL.PHP_EOL,FILE_APPEND);
    return 'ok';
});*/

/*Route::get('/public/'.env('TELEGRAM_BOT_TOKEN').'/webhook_activate.php', function () {
    return view('welcome');
});*/
//Route::get('/public/token/webhook_activate.php', function () {
//    return view('welcome');
//});

Route::post('/','Bot\InputController@index');
Route::get('/test','Bot\InputController@test');