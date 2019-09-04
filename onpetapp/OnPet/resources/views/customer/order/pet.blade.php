@extends('layouts.template')

@section('maincontent')
<table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Petshop Name</th>
        <th class="text-center">Pet Name</th>
        <th class="text-center">Info</th>
        <th class="text-center">Purchased</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>

@foreach($orderpets as $ops)
      <tr>
            <td class="text-center">{{$ops->id}}</td>
            <td class="text-center">{{$ops->petshop_name}}</td>
            <td class="text-center">{{$ops->pet_name}}</td>
            <td class="text-center">
            @if($ops->confirmed == 0)
              Inqueue
            @elseif($ops->status == 0 && $ops->confirmed == 1)
              Rejected
            @elseif($ops->status == 1 && $ops->confirmed == 1)
              Approved
            @endif
            </td>
            <td class="text-center">
            @if($ops->purchased == 0)
              &#x2612;
            @elseif($ops->purchased == 1)
              &#x2611;
            @endif
            </td>
            <td class="text-center">
            @if($ops->purchased == 0 && $ops->testimoni == "" && $ops->status == 1)
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$ops->id}}">Purchase and Give Testimoni</button>
                <div id="myModal{{$ops->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Testimoni for {{$ops->pet_name}}</h4>
                            </div>
                            <form action="{{route('purchased_order_pet')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="text" style="border:1px solid black" name="testimoni">
                                <input type="hidden" value="{{$ops->id}}" name="ops_id">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success">Purchase</button>
                            </div>
                            </form>
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