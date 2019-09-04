<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Product;
use DB;
use App\OrderProduct;
use Session;

class ProductController extends Controller
{
    public function product_petshop_list()
    {
        $products = Product::where('id_petshop',Session::get('type-petshop-id'))->get();
        return view('petshop.product-list',['products'=>$products]);
    }

    public function product_list()
    {
        $products = DB::table('petshop')->join('product','product.id_petshop','=','petshop.id')
                                        ->select(
                                            'product.name as product_name',
                                            'petshop.name as petshop_name',
                                            'product.price','product.description','product.id','product.filename'
                                        )->get();
        return view('customer.product-list',['products'=>$products]);
    }

    public function add_product_petshop(Request $request)
    {
        $picture = $request->file('picture');
        $extension = $picture->getClientOriginalExtension();
        Storage::disk('public')->put($picture->getFilename().'.'.$extension, File::get($picture));

        $product = new Product();
        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->id_petshop = Session::get('type-petshop-id');
        $product->description = $request->get('description');
        $product->filename = $picture->getFilename().'.'.$extension;
        $product->mime = $picture->getClientMimeType();
        $product->original_filename = $picture->getClientOriginalName();
        $product->save();

        return redirect('/petshop/products');
    }

    public function show_customer_order_product()
    {
        $order_products = DB::table('order_product')
        ->join('product','product.id','=','order_product.id_product')
        ->join('petshop','petshop.id','=','product.id_petshop')
        ->where('order_product.id_customer','=',Session::get('type-customer-id'))
        ->select(
            'order_product.id as op_id',
            'petshop.name as op_petshop_name',
            'product.name as op_product_name',
            'order_product.quantity as op_quantity',
            'order_product.confirmed as op_confirmed',
            'order_product.status as op_status',
            'order_product.purchased as op_purchased',
            'order_product.testimoni',
            'order_product.purchased'
        )->get();
        return view('customer.order.product',['order_products'=>$order_products]);
    }

    public function purchased_order_product(Request $request)
    {
        $id = $request->get('id');
        $op = OrderProduct::find($id);
        $op->testimoni = $request->get('testimoni');
        $op->purchased = 1;
        $op->save();
        return redirect('/customer/order/product');
    }

    public function show_petshop_order_product()
    {
        $order_products = DB::table('order_product')
                                ->join('customer','customer.id','=','order_product.id_customer')
                                ->join('product','product.id','=','order_product.id_product')
                                ->where('product.id_petshop','=',Session::get('type-petshop-id'))
                                ->select(
                                    'order_product.id as op_id',
                                    'customer.name as op_customer_name',
                                    'product.name as op_product_name',
                                    'order_product.quantity as op_quantity',
                                    'order_product.confirmed as op_confirmed',
                                    'order_product.status as op_status',
                                    'order_product.purchased as op_purchased',
                                    'order_product.testimoni'
                                )->get();
        return view('petshop.order.product',['order_products'=>$order_products]);
    }

    public function approve_order_product(Request $request)
    {
        $id = $request->get('id');
        $op = OrderProduct::find($id);
        $op->confirmed = 1;
        $op->status = 1;
        $op->save();
        return redirect('/petshop/order/product');
    }

    public function reject_order_product(Request $request)
    {
        $id = $request->get('id');
        $op = OrderProduct::find($id);
        $op->confirmed = 1;
        $op->status = 0;
        $op->save();
        return redirect('/petshop/order/product');
    }
}