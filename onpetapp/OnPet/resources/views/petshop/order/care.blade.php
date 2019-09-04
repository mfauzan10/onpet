@extends('layouts.template')

@section('maincontent')
<table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Customer Name</th>
        <th class="text-center">Care Name</th>
        <th class="text-center">Start Date</th>
        <th class="text-center">End Date</th>
        <th class="text-center">Confirmed</th>
        <th class="text-center">Status</th>
        <th class="text-center">Purchased</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
@foreach($ordercares as $oc)
      <tr>
        <td class="text-center">{{$oc->id}}</td>
        <td class="text-center">{{$oc->customer_name}}</td>
        <td class="text-center">{{$oc->care_name}}</td>
        <td class="text-center">{{$oc->startdate}}</td>
        <td class="text-center">{{$oc->enddate}}</td>
        <td class="text-center">
        @if ($oc->confirmed == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if ($oc->status == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if ($oc->purchased == 0) 
            &#x2612;
        @else
            &#x2611;
        @endif
        </td>
        <td class="text-center">
        @if($oc->confirmed == 0) 
            <form action="{{route('approve_order_care')}}" method="post">
                @csrf
                <input type="hidden" value="{{$oc->id}}" name="id">
                <button type="submit" class="btn btn-success">Approve</button>
            </form>
            <form action="{{route('reject_order_care')}}" method="post">
                @csrf
                <input type="hidden" value="{{$oc->id}}" name="id">
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        @elseif($oc->purchased == 1 && $oc->testimoni != "")

<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$oc->id}}">View Testimoni</button>
<div id="myModal{{$oc->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <h4 class="modal-title">{{$oc->care_name}}</h4>
            </div>
            <div class="modal-body">
                <p>{{$oc->testimoni}}</p>
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