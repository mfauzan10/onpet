<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderProduct;
use App\OrderCare;
use App\OrderPet;
use App\OrderVet;

class DashboardController extends Controller
{
    public function show_dashboard()
    {
        $opr_queue = 0;
        $opr_queue = OrderProduct::all()->where('confirmed','=',0)->count();
        $opr_progress = 0;
        $opr_progress = OrderProduct::all()->where('confirmed','=',1)->where('status','=',1)->where('purchased','=',0)->count();
        $opr_done = 0;
        $opr_done = OrderProduct::all()->where('purchased','=',1)->count();
        
        $oc_queue = 0;
        $oc_queue = OrderCare::all()->where('confirmed','=',0)->count();
        $oc_progress = 0;
        $oc_progress = OrderCare::all()->where('confirmed','=',1)->where('status','=',1)->where('purchased','=',0)->count();
        $oc_done = 0;
        $oc_done = OrderCare::all()->where('purchased','=',1)->count();
        
        $op_queue = 0;
        $op_queue = OrderPet::all()->where('confirmed','=',0)->count();
        $op_progress = 0;
        $op_progress = OrderPet::all()->where('confirmed','=',1)->where('status','=',1)->where('purchased','=',0)->count();
        $op_done = 0;
        $op_done = OrderPet::all()->where('purchased','=',1)->count();
        
        $ov_queue = 0;
        $ov_queue = OrderVet::all()->where('confirmed','=',0)->count();
        $ov_progress = 0;
        $ov_progress = OrderVet::all()->where('confirmed','=',1)->where('status','=',1)->where('purchased','=',0)->count();
        $ov_done = 0;
        $ov_done = OrderVet::all()->where('purchased','=',1)->count();
        
        return view('petshop.dashboard',[
            'opr_success'=>$opr_done,
            'opr_progress'=>$opr_progress,
            'opr_queue'=>$opr_queue,

            'oc_success'=>$oc_done,
            'oc_progress'=>$oc_progress,
            'oc_queue'=>$oc_queue,

            'op_success'=>$op_done,
            'op_progress'=>$op_progress,
            'op_queue'=>$op_queue,

            'ov_success'=>$ov_done,
            'ov_progress'=>$ov_progress,
            'ov_queue'=>$ov_queue
        ]);
    }
}
