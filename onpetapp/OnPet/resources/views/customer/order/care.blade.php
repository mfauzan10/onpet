@extends('layouts.template')

@section('maincontent')
<table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Petshop Name</th>
        <th class="text-center">Care Name</th>
        <th class="text-center">Start Date</th>
        <th class="text-center">End Date</th>
        <th class="text-center">Information</th>
        <th class="text-center">Info</th>
        <th class="text-center">Purchased</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>

@foreach($ordercares as $oc)
      <tr>
            <td class="text-center">{{$oc->id}}</td>
            <td class="text-center">{{$oc->petshop_name}}</td>
            <td class="text-center">{{$oc->care_name}}</td>
            <td class="text-center">{{$oc->startdate}}</td>
            <td class="text-center">{{$oc->enddate}}</td>
            <td class="text-center">{{$oc->information}}</td>
            <td class="text-center">
                @if($oc->confirmed == 0)
                    Inqueue
                @elseif($oc->status == 1)
                    Approved
                @else
                    Rejected
                @endif
            </td>
            <td class="text-center">
                @if($oc->purchased == 0)
                    &#x2612;
                @else
                    &#x2611;
                @endif
            </td>
            <td class="text-center">
                @if($oc->status == 1 && $oc->testimoni == "" && $oc->purchased == 0 )
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$oc->id}}">Purchase and Give Testimoni</button>
                <div id="myModal{{$oc->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Testimoni for {{$oc->care_name}}</h4>
                            </div>
                            <form action="{{route('purchased_order_care')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="text" style="border:1px solid black" name="testimoni">
                                <input type="hidden" value="{{$oc->id}}" name="oc_id">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success">Purchase</button>
                            </div>
                            </form>
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