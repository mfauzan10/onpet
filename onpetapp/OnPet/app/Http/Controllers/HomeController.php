<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        return redirect('/');
    }

    public function contact()
    {
        return view('contact');
    }

    public function service()
    {
        return view('service');
    }

    public function blog()
    {
        return view('blog');
    }

    public function about()
    {
        return view('about');
    }

    public function search()
    {
        return view('search');
    }

    public function search_operation(Request $request)
    {
        $parameter = $request->get('parameter');
        if($parameter == null) return back();
        $type = $request->get('type');
        $result = DB::table($type)->join('petshop','petshop.id','=',$type.'.id_petshop')
                                    ->where($type.'.name','like','%' . $parameter . '%')
                                    ->select(
                                        $type.'.id',
                                        $type.'.name as name',
                                        $type.'.filename',
                                        $type.'.price',
                                        $type.'.description',
                                        'petshop.name as petshop_name'
                                    )
                                    ->get();
        $testimoni = DB::table('order_'.$type)->join($type,$type.'.id','=','order_'.$type.'.id_'.$type)->join('customer','customer.id','=','order_'.$type.'.id_customer')
                                            ->select(
                                                $type.'.id as t_id',
                                                'order_'.$type.'.testimoni',
                                                'customer.name as customer_name'
                                            )
                                            ->where('order_'.$type.'.purchased','=',1)
                                            ->get();
        $count_result = count($result);
        $count_testimoni = count($testimoni);
        return view('search_result',['count_testimoni'=>$count_testimoni,'count_result'=>$count_result,'result'=>$result,'testimoni'=>$testimoni]);
    }
}