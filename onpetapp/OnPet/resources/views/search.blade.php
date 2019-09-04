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
@endsection