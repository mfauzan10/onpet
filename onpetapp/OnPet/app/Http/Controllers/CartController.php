<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Cart;
use App\OrderProduct;

class CartController extends Controller
{
    public function customer_cart()
    {
        $carts = DB::table('cart')
                    ->join('product','cart.id_product','=','product.id')
                    ->join('petshop','petshop.id','=','product.id_petshop')
                    ->select(
                        'cart.id as cart_id',
                        'petshop.name as petshop_name',
                        'product.name as product_name',
                        'product.price as product_price',
                        'cart.quantity as product_quantity'
                    )->where('cart.id_customer','=',Session::get('type-customer-id'));
        $price = $carts->pluck('product_price')->toArray();
        $quantity = $carts->pluck('product_quantity')->toArray();
        $count =  count($quantity);
        $total_price = 0;
        for($i=0;$i<$count;$i++)
        {
            $total_price = $total_price + ($price[$i] * $quantity[$i]);
        }
        return view('customer.cart',['carts'=>$carts->get(),'total_price'=>$total_price]);
    }

    public function add_to_cart(Request $request)
    {
        $cart = new Cart([
            'id_customer' => $request->get('id_customer'),
            'id_product' => $request->get('id_product'),
            'quantity' => $request->get('quantity')
        ]);
        $cart->save();
        return redirect('customer/cart');
    }

    public function remove_from_cart(Request $request)
    {
        $cart = Cart::find($request->get('cart_id'));
        $cart->delete();
        
        return redirect('customer/cart');
    }

    public function order_all()
    {
        $id_customer = Cart::all()->pluck('id_customer')->toArray();
        $id_product = Cart::all()->pluck('id_product')->toArray();
        $quantity = Cart::all()->pluck('quantity')->toArray();
        $count =  count($id_customer);
        for($i=0;$i<$count;$i++)
        {
            $order_product = new OrderProduct([
                'id_customer' => $id_customer[$i],
                'id_product' => $id_product[$i],
                'quantity' => $quantity[$i]
            ]);
            $order_product->save();
        }
        $carts = Cart::where('id_customer',$id_customer)->delete();
        return redirect('customer/cart');
    }
}