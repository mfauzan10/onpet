<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petshop extends Model
{
    protected $primary = 'id';
    protected $table = 'petshop';
    public $timestamps = false;
    protected $fillable = ['name','address','telephone_number','email','password'];
    protected $hidden = 'password';
}
