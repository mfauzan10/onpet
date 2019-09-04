<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primary = 'id';
    protected $table = 'customer';
    public $timestamps = false;
    protected $fillable = ['name','address','telephone_number','email','password'];
    protected $hidden = 'password';
}
