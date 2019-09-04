@extends('layouts.template')

@section('maincontent')
<table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Petshop Name</th>
        <th class="text-center">Product Name</th>
        <th class="text-center">Product Quantity</th>
        <th class="text-center">Info</th>
        <th class="text-center">Purchased</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>

@foreach($order_products as $op)
      <tr>
        
        <td class="text-center">{{$op->op_id}}</td>
        <td class="text-center">{{$op->op_petshop_name}}</td>
        <td class="text-center">{{$op->op_product_name}}</td>
        <td class="text-center">{{$op->op_quantity}}</td>
        <td class="text-center">
        @if($op->op_confirmed == 1 && $op->op_status == 1)
            Approved
        @elseif($op->op_confirmed == 1 && $op->op_status == 0)
            Rejected
        @else
            Inqueue
        @endif
        </td>
        <td class="text-center">
        @if($op->op_purchased == 0)
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        
        @if($op->op_status == 1 && $op->testimoni == "" && $op->purchased == 0)
            <td class="text-center">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$op->op_id}}">Purchase and Give Testimoni</button>
                <div id="myModal{{$op->op_id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Testimoni for {{$op->op_product_name}}</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('purchased_order_product')}}" method="post">
                                    @csrf
                                    <input style="border:1px solid" type="text" name="testimoni">
                                    <input type="hidden" name="id" value="{{$op->op_id}}">
                                    <div class="row">
                                        <button type="submit" class="btn btn-success">Purchase</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        @endif

      </tr>
@endforeach 
    
    </tbody>
</table>
@endsection