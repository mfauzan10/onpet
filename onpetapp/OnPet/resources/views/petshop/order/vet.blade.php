@extends('layouts.template')

@section('maincontent')
<table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Customer Name</th>
        <th class="text-center">Vet Name</th>
        <th class="text-center">Due Date</th>
        <th class="text-center">Confirmed</th>
        <th class="text-center">Status</th>
        <th class="text-center">Purchased</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
@foreach($ordervets as $ov)
      <tr>
        <td class="text-center">{{$ov->id}}</td>
        <td class="text-center">{{$ov->customer_name}}</td>
        <td class="text-center">{{$ov->vet_name}}</td>
        <td class="text-center">{{$ov->duedate}}</td>
        <td class="text-center">
        @if ($ov->confirmed == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if ($ov->status == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if ($ov->purchased == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if($ov->confirmed == 0) 
            <form action="{{route('approve_order_vet')}}" method="post">
                @csrf
                <input type="hidden" value="{{$ov->id}}" name="id">
                <button type="submit" class="btn btn-success">Approve</button>
            </form>
            <form action="{{route('reject_order_vet')}}" method="post">
                @csrf
                <input type="hidden" value="{{$ov->id}}" name="id">
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        @elseif($ov->purchased == 1 && $ov->testimoni != "")

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$ov->id}}">View Testimoni</button>
<div id="myModal{{$ov->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <h4 class="modal-title">{{$ov->vet_name}}</h4>
            </div>
            <div class="modal-body">
                <p>{{$ov->testimoni}}</p>
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