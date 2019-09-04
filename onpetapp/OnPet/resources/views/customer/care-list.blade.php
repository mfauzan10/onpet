@extends('layouts.template')

@section('maincontent')

<section class="container section">
    <div class="module-wrapper shop-layout text-center">        
    @foreach($cares as $care)
        <div class="col-md-3 grid cs-style-3" style="border-">
            <div class="img-wrap white">
                <figure>
                    <img class="card-img-top" style="height:150px; width:270px" src="{{url('uploads/'.$care->filename)}}" alt="{{$care->filename}}" class="img-responsive">
                        <figcaption>
                            <p style="text-align:center;" class="card-text"><strong>Rp {{$care->price}} </strong></p>
                        </figcaption>
                </figure>
            </div>
            <h4><p class="card-text">{{$care->care_name}} - [{{$care->petshop_name}}]</p></h4>
            <p class="card-text">{{$care->description}}</p>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{$care->id}}">Book</button>
            <div id="myModal{{$care->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{$care->care_name}}</h4>
                        </div>
                        <form action="{{route('order_care')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                Start Date <input type="date" name="startdate" style="border:1px black solid"><br>
                                End Date <input type="date" name="enddate" style="border:1px black solid"><br>
                                Additional Information <input type="text" name="information" style="border:1px black solid"><br>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="id_customer" value="{{Session::get('type-customer-id')}}">
                                <input type="hidden" name="id_care" value="{{$care->id}}">
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