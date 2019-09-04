@extends('layouts.template')

@section('maincontent')
<table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Customer Name</th>
        <th class="text-center">Product Name</th>
        <th class="text-center">Product Quantity</th>
        <th class="text-center">Confirmed</th>
        <th class="text-center">Status</th>
        <th class="text-center">Purchased</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
@foreach($order_products as $op)
      <tr>
        <td class="text-center">{{$op->op_id}}</td>
        <td class="text-center">{{$op->op_customer_name}}</td>
        <td class="text-center">{{$op->op_product_name}}</td>
        <td class="text-center">{{$op->op_quantity}}</td>
        <td class="text-center">
        @if ($op->op_confirmed == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if ($op->op_status == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if ($op->op_purchased == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if($op->op_confirmed == 0) 
            <form action="{{route('approve_order_product')}}" method="post">
                @csrf
                <input type="hidden" value="{{$op->op_id}}" name="id">
                <button type="submit" class="btn btn-success">Approve</button>
            </form>
            <form action="{{route('reject_order_product')}}" method="post">
                @csrf
                <input type="hidden" value="{{$op->op_id}}" name="id">
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        @elseif($op->op_purchased == 1 && $op->testimoni != "")

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$op->op_id}}">View Testimoni</button>
<div id="myModal{{$op->op_id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <h4 class="modal-title">{{$op->op_product_name}}</h4>
            </div>
            <div class="modal-body">
                <p>{{$op->testimoni}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

        @endif
        </td>
      </tr>
@endforeach

    </tbody>
</table>
@endsection