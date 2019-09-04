@extends('layouts.template')

@section('maincontent')
<table class="table table-hover">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Petshop Name</th>
        <th class="text-center">Vet Name</th>
        <th class="text-center">Due Date</th>
        <th class="text-center">Information</th>
        <th class="text-center">Info</th>
        <th class="text-center">Purchased</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>

@foreach($ordervets as $ov)
      <tr>
            <td class="text-center">{{$ov->id}}</td>
            <td class="text-center">{{$ov->petshop_name}}</td>
            <td class="text-center">{{$ov->vet_name}}</td>
            <td class="text-center">{{$ov->duedate}}</td>
            <td class="text-center">{{$ov->information}}</td>
            <td class="text-center">
            @if($ov->confirmed ==0)
                Inqueue
            @elseif($ov->confirmed==1 && $ov->status == 1)
                Approved
            @elseif($ov->confirmed==1 && $ov->status == 0)
                Rejected
            @endif
            </td>
            <td class="text-center">
            @if($ov->purchased == 0)
                &#x2612;
            @elseif($ov->purchased ==1)
                &#x2611;
            @endif
            </td>
            <td class="text-center">
            @if($ov->testimoni == "" && $ov->purchased == 0 && $ov->status == 1)
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal{{$ov->id}}">Purchase and Give Testimoni</button>
                <div id="myModal{{$ov->id}}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Testimoni for {{$ov->vet_name}}</h4>
                            </div>
                            <form action="{{route('purchased_order_vet')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="text" style="border:1px solid black" name="testimoni">
                                <input type="hidden" value="{{$ov->id}}" name="ov_id">
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