@extends('layouts.template')

@section('maincontent')
<div>
<form action="{{route('search_operation')}}" method="post">
    @csrf
    <input type="text" name="parameter" style="border:1px solid black">
    <select name="type">
        <option value="product">Product</option>
        <option value="care">Care</option>
        <option value="pet">Pet</option>
        <option value="vet">Vet</option>
    </select>
    <button type="submit" class="btn btn-success">Search</button>
</form>
</div>

<br>
<hr>
<br>

@if($count_result != 0)
<div class="module-wrapper shop-layout text-center">        
    @foreach($result as $data)
        <div class="col-md-3 grid cs-style-3" style="border-">
            <div class="img-wrap white">
                <figure>
                <img class="card-img-top" style="height:170px; width:310px" src="{{url('uploads/'.$data->filename)}}" alt="{{$data->filename}}">  
                        <figcaption>
                            <p style="text-align:center;" class="card-text"><strong>Rp {{$data->price}} </strong></p>
                        </figcaption>
                </figure>
            </div>
            <h4><p class="card-text">{{$data->name}} - [{{$data->petshop_name}}]</p></h4>
            <p class="card-text">{{$data->description}}</p>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{$data->id}}">View Testimoni</button>
            <div id="myModal{{$data->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{$data->name}}</h4>
                        </div>
                        <form action="" method="post">
                        <div class="modal-body">
                            @foreach($testimoni as $tes)
                                @if($tes->t_id == $data->id)
                                    {{$tes->customer_name}} -> {{$tes->testimoni}}
                                    <br>
                                @endif
                            @endforeach
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif

@endsection