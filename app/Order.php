<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function orders_detail()
    {
        return $this->hasMany('App\OrderDetail', 'orders_id');
    }
    public function products_detail()
    {
        return $this->hasMany('App\ProductDetail', 'products_id');
    }
    public function orders_status()
    {
        return $this->belongsTo('App\OrderStatus', 'orders_status_id');

    }
}
