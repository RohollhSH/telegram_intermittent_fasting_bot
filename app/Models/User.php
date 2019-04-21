<?php

namespace App\Models;

use App\Http\Controllers\Bot\InputController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*    protected $fillable = [
        ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*    protected $hidden = [
        ];*/

    const FASTING = 'fasting';
    const CHILLING = 'chilling';

    public static function getStatus($id)
    {
        $status = self::select('status')->where('telegram_user_id', $id)->first();
        return $status['status'];
    }

    public static function updateStatus($status)
    {
        self::where('telegram_user_id', InputController::$updates->message->from->id)->update(['status' => $status]);
    }
}
