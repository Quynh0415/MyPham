<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // 1 thương hiệu có nhiều sản phẩm
    public function products()
    {
        return $this->hasMany('App\Brand');
    }
}
