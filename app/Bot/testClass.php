<?php
/**
 * Created by PhpStorm.
 * User: Rohollah
 * Date: 03/27/2019
 * Time: 01:12 PM
 */

namespace app\Bot;


use Illuminate\Http\Request;

class testClass
{
    public function __construct()
    {
        file_put_contents('test.txt', 'works' . PHP_EOL . PHP_EOL, FILE_APPEND);
        var_dump(Request::class);
    }

}