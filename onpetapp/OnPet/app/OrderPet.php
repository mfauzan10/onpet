<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPet extends Model
{
    protected $primary = 'id';
    protected $table = 'order_pet';
    public $timestamps = false;
}
