@extends('layouts.template')

@section('maincontent')

<section class="container section">
    <div class="module-wrapper shop-layout text-center">        
    @foreach($products as $product)
        <div class="col-md-3 grid cs-style-3" style="border-">
            <div class="img-wrap white">
                <figure>
                    <img class="card-img-top" style="height:150px; width:270px" src="{{url('uploads/'.$product->filename)}}" alt="{{$product->filename}}" class="img-responsive">
                        <figcaption>
                            <p style="text-align:center;" class="card-text"><strong>Rp {{$product->price}} </strong></p>
                        </figcaption>
                </figure>
            </div>
            <h4><p class="card-text">{{$product->product_name}} - [{{$product->petshop_name}}]</p></h4>
            <p class="card-text">{{$product->description}}</p>
            <div>    
                <form action="{{route('add_to_cart')}}" method="post" class=" pull-right">
                    @csrf
                    <input type="hidden" name="id_customer" value="{{Session::get('type-customer-id')}}">
                    <input type="hidden" name="id_product" value="{{$product->id}}">
                    <input type="number" name="quantity" min="1" value="1">
                    <button class="btn btn-warning" type="submit"><i class="fa fa-shopping-cart"></i></button>
                </form>
            </div>
        </div>
    @endforeach
    </div>
</section>


@endsection