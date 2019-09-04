<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $primary = 'id';
    protected $table = 'order_product';
    public $timestamps = false;
    protected $fillable = ['id_customer','id_product','quantity'];
}