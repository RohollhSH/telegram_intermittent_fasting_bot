<?php
/**
 * Created by PhpStorm.
 * User: Rohollah
 * Date: 03/27/2019
 * Time: 01:13 PM
 */

namespace app\Http\Controllers\Bot;


use Illuminate\Http\Request;

class testControllerTest
{
    public function __construct()
    {
        file_put_contents('test.txt', 'works' . PHP_EOL . PHP_EOL, FILE_APPEND);
        var_dump(Request::class);
    }

}