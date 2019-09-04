@extends('layouts.template')

@section('maincontent')

<section class="container section">
    <div class="module-wrapper shop-layout text-center">        
    @foreach($pets as $pet)
        <div class="col-md-3 grid cs-style-3" style="border-">
            <div class="img-wrap white">
                <figure>
                <img class="card-img-top" style="height:150px; width:270px" src="{{url('uploads/'.$pet->filename)}}" alt="{{$pet->filename}}">  
                        <figcaption>
                            <p style="text-align:center;" class="card-text"><strong>Rp {{$pet->price}} </strong></p>
                        </figcaption>
                </figure>
            </div>
            <h4><p class="card-text">{{$pet->pet_name}} - [{{$pet->petshop_name}}]</p></h4>
            <p class="card-text">{{$pet->description}}</p>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{$pet->id}}">Book</button>
            <div id="myModal{{$pet->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{$pet->pet_name}}</h4>
                        </div>
                        <form action="{{route('order_pet')}}" method="post">
                        <div class="modal-body">
                            <p>Are you sure for adopting this pet ?</p>
                        </div>
                        <div class="modal-footer">
                                @csrf
                                <input type="hidden" name="id_customer" value="{{Session::get('type-customer-id')}}">
                                <input type="hidden" name="id_pet" value="{{$pet->id}}">
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