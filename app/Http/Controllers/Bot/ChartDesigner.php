<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
//&chxl=0:%7CMarch%20%2718%7CApril%20%2718%7CMay%20%2718%7CJune%20%2718%7CJuly%20%2718%7CAugust%20%2718%7C
//&chdl=Visitors%20%28in%20thousands%29
//&chf=b0,lg,90,05B142,1,0CE858,0.2
//&chxs=1N**K
//&chtt=Visitors%20report
//&chma=0,0,10,10
//&chl=%7C%7C%7C%7C+33%25%20!%7Cx2%20
}
