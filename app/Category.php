<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent()
    {
        // belongsto mối quan hệ nghịch đảo một danh mục con  chỉ ở 1 danh mục cha
        return $this->belongsTo("App\Category", "parent_id");
    }

    // 1 danh mục có nhiều sản phẩm
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
