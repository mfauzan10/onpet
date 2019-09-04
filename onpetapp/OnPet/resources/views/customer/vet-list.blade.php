@extends('layouts.template')

@section('maincontent')

<section class="container section">
    <div class="module-wrapper shop-layout text-center">        
    @foreach($vets as $vet)
        <div class="col-md-3 grid cs-style-3" style="border-">
            <div class="img-wrap white">
                <figure>
                <img class="card-img-top" style="height:150px; width:265px" src="{{url('uploads/'.$vet->filename)}}" alt="{{$vet->filename}}">  
                        <figcaption>
                            <p style="text-align:center;" class="card-text"><strong>Rp {{$vet->price}} </strong></p>
                        </figcaption>
                </figure>
            </div>
            <h4><p class="card-text">{{$vet->vet_name}} - [{{$vet->petshop_name}}]</p></h4>
            <p class="card-text">{{$vet->description}}</p>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{$vet->id}}">Book</button>
            <div id="myModal{{$vet->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{$vet->vet_name}}</h4>
                        </div>
                        <form action="{{route('order_vet')}}" method="post">
                        <div class="modal-body">
                            @csrf
                            <input type="date" name="duedate" style="border:1px solid black">
                            <input type="text" name="information" style="border:1px solid black">
                            <input type="hidden" name="id_customer" value="{{Session::get('type-customer-id')}}">
                            <input type="hidden" name="id_vet" value="{{$vet->id}}">
                        </div>
                        <div class="modal-footer">
                                <button class="btn btn-success" type="submit">Book</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</section>


@endsection