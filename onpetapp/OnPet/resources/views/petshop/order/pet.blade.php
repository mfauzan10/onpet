@extends('layouts.template')

@section('maincontent')
<table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Customer Name</th>
        <th class="text-center">Pet Name</th>
        <th class="text-center">Confirmed</th>
        <th class="text-center">Status</th>
        <th class="text-center">Purchased</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
@foreach($orderpets as $op)
      <tr>
        <td class="text-center">{{$op->id}}</td>
        <td class="text-center">{{$op->customer_name}}</td>
        <td class="text-center">{{$op->pet_name}}</td>
        <td class="text-center">
        @if ($op->confirmed == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if ($op->status == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if ($op->purchased == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if($op->confirmed == 0) 
            <form action="{{route('approve_order_pet')}}" method="post">
                @csrf
                <input type="hidden" value="{{$op->id}}" name="id">
                <button type="submit" class="btn btn-success">Approve</button>
            </form>
            <form action="{{route('reject_order_pet')}}" method="post">
                @csrf
                <input type="hidden" value="{{$op->id}}" name="id">
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        @elseif($op->purchased == 1 && $op->testimoni != "")

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$op->id}}">View Testimoni</button>
<div id="myModal{{$op->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <h4 class="modal-title">{{$op->pet_name}}</h4>
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