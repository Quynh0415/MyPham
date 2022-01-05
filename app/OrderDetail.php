<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "orders_detail";

    public function orders()
    {
        return $this->belongsTo('App\Order', 'id', 'orders_id');
    }
}
