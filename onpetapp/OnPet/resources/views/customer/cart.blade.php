@extends('layouts.template')

@section('maincontent')


<table class="table table-hover">
    <thead>
        <tr>
            <th class="text-center">Product</th>
            <th class="text-center">Petshop</th>
            <th class="text-center">Price @</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Price Total</th>
            <th class="text-center">Action</th>
      </tr>
    </thead>
@foreach($carts as $cart)
    <tbody>
        <tr>
            <td class="text-center">{{$cart->product_name}}</td>
            <td class="text-center">{{$cart->petshop_name}}</td>
            <td class="text-center">{{$cart->product_price}}</td>
            <td class="text-center">{{$cart->product_quantity}}</td>
            <td class="text-center">{{$cart->product_price*$cart->product_quantity}}</td>
            <td>
            <form class="text-center" action="{{route('remove_from_cart')}}" method="post">
                @csrf
                <input type="hidden" name="cart_id" value="{{$cart->cart_id}}">
                <button type="submit" class="btn btn-danger">Remove</button>
            </form>
            </td>
        </tr>
    </tbody>
@endforeach
@if($total_price > 0)
    <tbody>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-center">Total</td>
        <td class="text-center">{{$total_price}}</td>
        <td>
        <form class="text-center" action="{{route('order_all')}}">
            @csrf
            <button type="submit" class="btn btn-success">Order</button>
        </form></td>
    </tbody>
@endif
</table>

@endsection