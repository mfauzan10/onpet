<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DB;
use App\Care;
use App\OrderCare;
use Session;

class CareController extends Controller
{
    public function care_petshop_list()
    {
        $cares = Care::where('id_petshop','=',Session::get('type-petshop-id'))->get();
        return view('petshop.care-list',['cares'=>$cares]);
    }

    public function care_list()
    {
        $cares = DB::table('care')->join('petshop','petshop.id','=','care.id_petshop')
                                ->select(
                                    'care.name as care_name',
                                    'petshop.name as petshop_name',
                                    'care.price','care.id','care.description','care.filename'
                                )->get();
        return view('customer.care-list',['cares'=>$cares]);
    }

    public function add_care_petshop(Request $request)
    {
        $picture = $request->file('picture');
        $extension = $picture->getClientOriginalExtension();
        Storage::disk('public')->put($picture->getFilename().'.'.$extension, File::get($picture));
        $care = new Care();
        $care->name = $request->get('name');
        $care->price = $request->get('price');
        $care->id_petshop = Session::get('type-petshop-id');
        $care->description = $request->get('description');
        $care->filename = $picture->getFilename().'.'.$extension;
        $care->mime = $picture->getClientMimeType();
        $care->original_filename = $picture->getClientOriginalName();
        $care->save();
        return redirect('/petshop/cares');
    }

    public function show_customer_order_care()
    {
        $ordercares = DB::table('order_care')->join('care','order_care.id_care','=','care.id')->join('petshop','petshop.id','=','care.id_petshop')
                                            ->select(
                                                'order_care.id','order_care.startdate','order_care.enddate','order_care.information','order_care.purchased','order_care.status','order_care.confirmed',
                                                'order_care.testimoni','petshop.name as petshop_name',
                                                'care.name as care_name'
                                                )
                                            ->where('order_care.id_customer','=',Session::get('type-customer-id'))
                                            ->get();
        return view('customer.order.care',['ordercares'=>$ordercares]);
    }

    public function show_petshop_order_care()
    {
        $ordercares = DB::table('order_care')->join('care','order_care.id_care','=','care.id')->join('customer','customer.id','=','order_care.id_customer')
            ->select(
            'order_care.id','order_care.startdate','order_care.enddate','order_care.information','order_care.purchased','order_care.status','order_care.confirmed',
            'order_care.testimoni','customer.name as customer_name',
            'care.name as care_name'
            )
            ->where('care.id_petshop','=',Session::get('type-petshop-id'))
            ->get();
        return view('petshop.order.care',['ordercares'=>$ordercares]);
    }

    public function order_care(Request $request)
    {
        $OrderCare = new OrderCare();
        $OrderCare->startdate = $request->get('startdate');
        $OrderCare->enddate = $request->get('enddate');
        $OrderCare->information = $request->get('information');
        $OrderCare->id_care = $request->get('id_care');
        $OrderCare->id_customer = $request->get('id_customer');
        $OrderCare->save();
        return redirect('/customer/order/care');
    }

    public function purchased_order_care(Request $request)
    {
        $oc = OrderCare::find($request->get('oc_id'));
        $oc->testimoni = $request->get('testimoni');
        $oc->purchased = 1;
        $oc->save();
        return redirect('/customer/order/care');
    }

    public function approve_order_care(Request $request)
    {
        $id = $request->get('id');
        $oc = OrderCare::find($id);
        $oc->confirmed = 1;
        $oc->status = 1;
        $oc->save();
        return redirect('/petshop/order/care');
    }

    public function reject_order_care(Request $request)
    {
        $id = $request->get('id');
        $oc = OrderCare::find($id);
        $oc->confirmed = 1;
        $oc->status = 0;
        $oc->save();
        return redirect('/petshop/order/care');
    }
}