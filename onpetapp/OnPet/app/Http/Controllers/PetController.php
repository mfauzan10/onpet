<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Pet;
use App\OrderPet;
use DB;
use Session;

class PetController extends Controller
{
    public function pet_petshop_list()
    {
        $pets = Pet::where('id_petshop','=',Session::get('type-petshop-id'))->get();
        return view('petshop.pet-list',['pets'=>$pets]); 
    }

    public function pet_list()
    {
        $pets = DB::table('pet')->join('petshop','pet.id_petshop','petshop.id')
                                ->select(
                                    'pet.name as pet_name',
                                    'petshop.name as petshop_name',
                                    'pet.id','pet.description','pet.price','pet.filename'
                                )->get();
        return view('customer.pet-list',['pets'=>$pets]);
    }

    public function add_pet_petshop(Request $request)
    {
        $picture = $request->file('picture');
        $extension = $picture->getClientOriginalExtension();
        Storage::disk('public')->put($picture->getFilename().'.'.$extension, File::get($picture));
        $pet = new Pet();
        $pet->name = $request->get('name');
        $pet->price = $request->get('price');
        $pet->id_petshop = Session::get('type-petshop-id');
        $pet->description = $request->get('description');
        $pet->filename = $picture->getFilename().'.'.$extension;
        $pet->mime = $picture->getClientMimeType();
        $pet->original_filename = $picture->getClientOriginalName();
        $pet->save();
        return redirect('/petshop/pets');
    }

    public function show_customer_order_pet()
    {
        $orderpets = DB::table('order_pet')->join('pet','pet.id','=','order_pet.id_pet')->join('petshop','petshop.id','pet.id_petshop')
                                            ->select(
                                                'order_pet.id','order_pet.confirmed','order_pet.status','order_pet.purchased','order_pet.testimoni',
                                                'petshop.name as petshop_name',
                                                'pet.name as pet_name'
                                            )
                                            ->where('order_pet.id_customer','=',Session::get('type-customer-id'))
                                            ->get();
        return view('customer.order.pet',['orderpets'=>$orderpets]);
    }
    
    public function show_petshop_order_pet()
    {
        $orderpets = DB::table('order_pet')->join('pet','pet.id','=','order_pet.id_pet')->join('customer','customer.id','order_pet.id_customer')
                                            ->select(
                                                'order_pet.id','order_pet.confirmed','order_pet.status','order_pet.purchased','order_pet.testimoni',
                                                'customer.name as customer_name',
                                                'pet.name as pet_name'
                                            )
                                            ->where('pet.id_petshop','=',Session::get('type-petshop-id'))
                                            ->get();
        return view('petshop.order.pet',['orderpets'=>$orderpets]);
    }

    public function order_pet(Request $request)
    {
        $orderpet = new OrderPet();
        $orderpet->id_customer = $request->get('id_customer');
        $orderpet->id_pet = $request->get('id_pet');
        $orderpet->save();
        return redirect('/customer/order/pet');
    }

    public function purchased_order_pet(Request $request)
    {
        $op = OrderPet::find($request->get('ops_id'));
        $op->purchased = 1;
        $op->testimoni = $request->get('testimoni');
        $op->save();
        return redirect('customer/order/pet');
    }

    public function approve_order_pet(Request $request)
    {
        $id = $request->get('id');
        $op = OrderPet::find($id);
        $op->confirmed = 1;
        $op->status = 1;
        $op->save();
        return redirect('/petshop/order/pet');
    }

    public function reject_order_pet(Request $request)
    {
        $id = $request->get('id');
        $op = OrderPet::find($id);
        $op->confirmed = 1;
        $op->status = 0;
        $op->save();
        return redirect('/petshop/order/pet');
    }
}
