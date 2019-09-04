@extends('layouts.template')

@section('maincontent')
<div class="row">
    <button type="button" class="col-lg-12 btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal"><strong>Add Vet</strong></button>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Vet</h4>
        </div>
        <div class="modal-body">
        <form method="post" action="{{route('add_vet_petshop')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" name="price"/>
        </div>
        <div class="form-group">
            <label for="descrption">Description:</label>
            <input type="text" class="form-control" name="description"/>
        </div>
        <div class="form-group">
            <label for="author">Image:</label>
            <input type="file" class="form-control" name="picture"/>
        </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
    </div>
    </div>
</div>


<section class="container section">
    <div class="module-wrapper shop-layout text-center">        
    @foreach($vets as $vet)
        <div class="col-md-3 grid cs-style-3" style="border-">
            <div class="img-wrap white">
                <figure>
                    <img class="card-img-top" style="height:150px; width:270px" src="{{url('uploads/'.$vet->filename)}}" alt="{{$vet->filename}}" class="img-responsive">
                        <figcaption>
                            <p style="text-align:center;" class="card-text"><strong>Rp {{$vet->price}} </strong></p>
                        </figcaption>
                </figure>
            </div>
            <h4><p class="card-text">{{$vet->name}}</p></h4>
            <p class="card-text">{{$vet->description}}</p>
        </div>
    @endforeach
    </div>
</section>


@endsection