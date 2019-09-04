@extends('layouts.template')

@section('maincontent')
    <div class="row" style="border:1px solid black; height:100px">
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderProduct - Queue</h2>
            <strong>{{$opr_queue}}</strong>
        </div>
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderProduct - Progress</h2>
            <strong>{{$opr_progress}}</strong>
        </div>
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderProduct - Done</h2>
            <strong>{{$opr_success}}</strong>
        </div>
    </div>
    <div class="row" style="border:1px solid black; height:100px">
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderCare - Queue</h2>
            <strong>{{$oc_queue}}</strong>
        </div>
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderCare - Progress</h2>
            <strong>{{$oc_progress}}</strong>
        </div>
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderCare - Done</h2>
            <strong>{{$oc_success}}</strong>
        </div>
    </div>
    <div class="row" style="border:1px solid black; height:100px">
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderPet - Queue</h2>
            <strong>{{$op_queue}}</strong>
        </div>
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderPet - Progress</h2>
            <strong>{{$op_progress}}</strong>
        </div>
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderPet - Done</h2>
            <strong>{{$op_success}}</strong>
        </div>
    </div>
    <div class="row" style="border:1px solid black; height:100px">
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderVet - Queue</h2>
            <strong>{{$ov_queue}}</strong>
        </div>
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderVet - Progress</h2>
            <strong>{{$ov_progress}}</strong>
        </div>
        <div class="col-lg-4 text-center" style="border:1px solid black; height:100px">
            <h2>OrderVet - Done</h2>
            <strong>{{$ov_success}}</strong>
        </div>
    </div>
@endsection