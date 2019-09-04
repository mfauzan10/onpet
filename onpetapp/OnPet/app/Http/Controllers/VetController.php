<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Vet;
use App\OrderVet;
use DB;
use Session;

class VetController extends Controller
{
    public function vet_petshop_list()
    {
        $vets = Vet::where('id_petshop','=',Session::get('type-petshop-id'))->get();
        return view('petshop.vet-list',['vets'=>$vets]); 
    }

    public function vet_list()
    {
        $vets = DB::table('vet')->join('petshop','petshop.id','=','vet.id_petshop')
                                ->select(
                                    'vet.name as vet_name',
                                    'petshop.name as petshop_name',
                                    'vet.id','vet.filename','vet.description','vet.price'
                                )->get();
        return view('customer.vet-list',['vets'=>$vets]);
    }

    public function add_vet_petshop(Request $request)
    {
        $picture = $request->file('picture');
        $extension = $picture->getClientOriginalExtension();
        Storage::disk('public')->put($picture->getFilename().'.'.$extension, File::get($picture));
        $vet = new Vet();
        $vet->name = $request->get('name');
        $vet->price = $request->get('price');
        $vet->id_petshop = Session::get('type-petshop-id');
        $vet->description = $request->get('description');
        $vet->filename = $picture->getFilename().'.'.$extension;
        $vet->mime = $picture->getClientMimeType();
        $vet->original_filename = $picture->getClientOriginalName();
        $vet->save();
        return redirect('/petshop/vets');
    }

    public function show_customer_order_vet()
    {
        $ordervets = DB::table('order_vet')->join('vet','vet.id','=','order_vet.id_vet')->join('petshop','petshop.id','vet.id_petshop')
                                            ->select(
                                                'order_vet.id','order_vet.duedate','order_vet.information','order_vet.confirmed','order_vet.status','order_vet.purchased','order_vet.testimoni',
                                                'vet.name as vet_name',
                                                'petshop.name as petshop_name'
                                            )
                                            ->where('order_vet.id_customer','=',Session::get('type-customer-id'))
                                            ->get();
        return view('customer.order.vet',['ordervets'=>$ordervets]);
    }

    public function show_petshop_order_vet()
    {
        $ordervets = DB::table('order_vet')->join('vet','vet.id','=','order_vet.id_vet')->join('customer','customer.id','=','order_vet.id_customer')
                                            ->select(
                                                'order_vet.id','order_vet.duedate','order_vet.information','order_vet.confirmed','order_vet.status','order_vet.purchased','order_vet.testimoni',
                                                'vet.name as vet_name',
                                                'customer.name as customer_name'
                                            )
                                            ->where('vet.id_petshop','=',Session::get('type-petshop-id'))
                                            ->get();
        return view('petshop.order.vet',['ordervets'=>$ordervets]);
    }

    public function order_vet(Request $request)
    {
        $ordervet = new OrderVet();
        $ordervet->duedate = $request->get('duedate');
        $ordervet->information = $request->get('information');
        $ordervet->id_vet = $request->get('id_vet');
        $ordervet->id_customer = $request->get('id_customer');
        $ordervet->save();
        return redirect('/customer/order/vet');
    }

    public function purchased_order_vet(Request $request)
    {
        $ov = OrderVet::find($request->get('ov_id'));
        $ov->purchased =1 ;
        $ov->testimoni = $request->get('testimoni');
        $ov->save();
        return redirect('/customer/order/vet');
    }

    public function approve_order_vet(Request $request)
    {
        $id = $request->get('id');
        $ov = OrderVet::find($id);
        $ov->confirmed = 1;
        $ov->status = 1;
        $ov->save();
        return redirect('/petshop/order/vet');
    }

    public function reject_order_vet(Request $request)
    {
        $id = $request->get('id');
        $ov = OrderVet::find($id);
        $ov->confirmed = 1;
        $ov->status = 0;
        $ov->save();
        return redirect('/petshop/order/vet');
    }
}