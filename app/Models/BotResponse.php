<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class BotResponse extends Model
{
    public static function SaveMessage($response_id,$response_json)
    {
        $response = new BotResponse();
        $response->response_id = $response_id;
        $response->response_json = $response_json;
        $response->save();
    }
}