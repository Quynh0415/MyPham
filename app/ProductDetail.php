<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    public function products()
    {
        return $this->belongsTo('App\Product', 'products_id');
    }
    protected $table = 'products_detail';
}
