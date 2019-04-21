<?php

namespace App\Http\Controllers\Bot;

use DateTime;
use DateTimeZone;
use App\Http\Controllers\Controller;
use Telegram;
use Telegram\Bot\Keyboard\Keyboard;

class Timezones extends Controller
{

    public static function Regions()
    {
        return array(
            DateTimeZone::AFRICA,
            DateTimeZone::AMERICA,
            DateTimeZone::ANTARCTICA,
            DateTimeZone::ASIA,
            DateTimeZone::ATLANTIC,
            DateTimeZone::AUSTRALIA,
            DateTimeZone::EUROPE,
            DateTimeZone::INDIAN,
            DateTimeZone::PACIFIC,
        );
    }

    public static function getTimeZones($regions)
    {
        $timezones        = array();
        $timezones        = array_merge($timezones, DateTimeZone::listIdentifiers($regions));
        $timezone_offsets = array();
        foreach ($timezones as $timezone) {
            $tz                          = new DateTimeZone($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
        }

// sort timezone by offset
        asort($timezone_offsets);
        $timezone_list = array();
        foreach ($timezone_offsets as $timezone => $offset) {
            $offset_prefix    = $offset < 0 ? '-' : '+';
            $offset_formatted = gmdate('H:i', abs($offset));

            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

            $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
        }

        return $timezone_list;
    }

    public static function test()
    {
        $keyboard = Keyboard::make()
                            ->inline()
                            ->row(Keyboard::inlineButton([
                                'text'          => 'ok',
                                'callback_data' => 1,
                            ]));
        $response = Telegram::editMessageText([
            'chat_id'      => 138727887,
            'message_id'   => 3687,
            'text'         => 'select country or regen',
            'reply_markup' => $keyboard
        ]);
        dd($response);
    }
}
