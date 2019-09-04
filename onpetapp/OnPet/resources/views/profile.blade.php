@extends('layouts.template')

@section('maincontent')
<div>
    <div>
        Nama : {{$profile->name}}
    </div>
    <br>
    <div>
        Email : {{$profile->email}}
    </div>
    <br>
    <div>
        Alamat : {{$profile->address}}
    </div> 
    <br>
    <div>
        Telephone : {{$profile->telephone_number}}
    </div>
    <br>

</div>
@endsection