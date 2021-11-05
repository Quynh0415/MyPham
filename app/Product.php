<?php

namespace App;

//use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//    use ElasticquentTrait;

    public function categories()
    {
        return $this->belongsTo('App\Category', 'categories_id');
    }

    public function brands()
    {
        return $this->belongsTo('App\Brand', 'brands_id');
    }

    public function products_detail()
    {
        return $this->hasMany('App\ProductDetail', 'products_id');
    }

    public function products_image()
    {
        return $this->hasMany('App\ProductImage', 'products_id');
    }
}
