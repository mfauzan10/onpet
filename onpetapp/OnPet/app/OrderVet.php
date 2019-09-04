<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderVet extends Model
{
    protected $primary = 'id';
    protected $table = 'order_vet';
    public $timestamps = false;
}
