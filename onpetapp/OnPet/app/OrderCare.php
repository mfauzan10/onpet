<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderCare extends Model
{
    protected $primary = 'id';
    protected $table = 'order_care';
    public $timestamps = false;
}
