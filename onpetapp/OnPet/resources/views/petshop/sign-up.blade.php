@extends('layouts.template')

@section('maincontent')

<section class="section banner" style="background-image:url({{ URL::asset('petvet/upload/xblog_bg.jpg.pagespeed.ic.6FShpY5eNF.jpg') }})" data-img-width="1688" data-img-height="470" data-diff="100">
</section>
<div class="page-title grey">
<div class="container">
<div class="title-area pull-left">
<h2>Sign Up <small>Get a premium support now!</small></h2>
<div class="bread">
<ol class="breadcrumb">
<li><a href="#">Home</a></li>
<li class="active">Sign Up</li>
</ol>
</div>
</div>
<div class="search pull-right">
<form>
<div class="input-group">
<input class="form-control" name="s" type="search" placeholder=" Search... ">
<span class="input-group-btn">
<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
</span>
</div>
</form>
</div>
</div>
</div>
<section class="section white">
<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-3 col-xs-12">
<div class="appoform-wrapper">
<form method="POST" action="{{ route('create_petshop') }}">
@csrf
<header class="form-header">
    <h3>Petshop Register Form</h3>
</header>
<fieldset class="row-fluid appoform">
<div class="col-md-12">
    <label class="sr-only">Petshop Name</label>
    <input id="name" name="name" type="text" placeholder="Petshop Name" class="form-control">
</div>
<div class="col-md-12">
    <label class="sr-only">Email</label>
    <input type="text" id="email" name="email" placeholder="Email" class="form-control">
</div>
<div class="col-md-12">
    <label class="sr-only">Address</label>
    <input id="telepon" name="telephone_number" type="text" placeholder="Telephone Number" class="form-control">
</div>
<div class="col-md-12">
    <label class="sr-only">Password</label>
    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
</div>
<div class="col-md-12">
    <label class="sr-only">Alamat</label>
    <input type="text" id="alamat" name="address" placeholder="Address" class="form-control">
</div>
<div class="col-md-12">
<button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
</div>

</fieldset>
</form>
</div>
</div>
</div>
</div>
</section>
@endsection