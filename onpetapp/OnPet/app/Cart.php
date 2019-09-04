<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primary = 'id';
    protected $table = 'cart';
    public $timestamps = false;
    protected $fillable = ['id_product','id_customer','quantity'];
}
