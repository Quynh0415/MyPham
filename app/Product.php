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
}
