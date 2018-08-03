<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    //
    public function index(Request $request)
    {
        $day=date('Y-m-d',time());
        $day_end=date('Y-m-d',time()+3600*24);
        if ($request->date){
            $day=date('Y-m-d',strtotime($request->date));
            $day_end=date('Y-m-d',strtotime($request->date)+3600*24);
        }
        if ($request->month){
            $time=   mktime(0,0,0,$request->month,date('d'),date('Y'));
            $day=date('Y-m',$time);
            $day_end=date('Y-m',strtotime('+1 month',$time));
        }
        $shops=DB::select('SELECT p.shop_name, count(o.id) as sum FROM  orders as o JOIN shops as p ON  o.shop_id=p.id   WHERE o.created_at>? AND o.created_at<? GROUP BY p.id ',[$day,$day_end]);
        $data=DB::select('SELECT p.shop_name, count(o.id) as sum FROM  orders as o JOIN shops as p ON  o.shop_id=p.id  GROUP BY p.id');

        return view('statistics/index',['shops'=>$shops,'data'=>$data]);
    }
}
