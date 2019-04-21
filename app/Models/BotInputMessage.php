<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotInputMessage extends Model
{
    public static function UsersLastMessage($user_id)
    {
        return self::select('message_id')
                   ->where('user_id', $user_id)
                   ->orderBy('created_at', 'desc')
                   ->first();
    }
}
