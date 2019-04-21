<?php

namespace App\Http\Controllers\Bot;

use App\Models\Fast;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use DatePeriod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class ChartDesigner extends Controller
{
    //using online api for making charts:
    //https://image-charts.com/chart
    //?cht=<chart_type>
    //&chd=<chart_data>
    //&chs=<chart_size>
    //&...additional_parameters...
//https://image-charts.com/chart
//?cht=bvg
//&chd=t:10,15,25,30,40,80
//&chs=700x300
//&chxt=x,y
//&chxl=0:|March '18|April '18|May '18|June '18|July '18|August '18|
//&chdl=Visitors (in thousands)
//&chf=b0,lg,90,05B142,1,0CE858,0.2
//&chxs=1N**K
//&chtt=Visitors%20report
//&chma=0,0,10,10
//&chl=||||+33% !|x2
//&chds=a

    public static function oneMonthFastChart()
    {
        $fasts    = Fast::UsersDaysFasts();
        $all_days = self::last_thirty_days();
        $all_days = array_merge($all_days, $fasts);
        $all_days = array_reverse($all_days);
//        $chd  = 't:'.'12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12|'.implode(',',array_values($all_days));
        $chd  = 't:'.implode(',',array_values($all_days));
        $chxl = '0:|'.implode('|', array_keys($all_days)).'|';

        return "https://image-charts.com/chart?cht=bvg&chds=a&chd=$chd&chs=900x500&chxt=x,y&chxl=$chxl&chtt=How many hours you fasted in what day&chf=b0,lg,0,FFE7C6,0,76A4FB,1&chxs=1N**hour";
    }

    public static function last_thirty_days()
    {
        $days = [];
        for ($i = 0; $i < 30; $i++) {
            $days[Carbon::now()->subDays($i)->format('M-d')] = 0;
        }

        return $days;
    }
}