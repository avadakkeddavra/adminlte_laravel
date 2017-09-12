<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductsTags;
use App\Models\Products;

class Tags extends Model
{
    protected  $table = 'tags';

    protected $fillable = ['id','tag_name'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function products()
    {

        return   $this->belongsToMany(Products::class,'products-tags','tag_id','product_id');

    }
    public function products_tags()
    {
        return $this->hasMany(ProductsTags::class,'tag_id','id');
    }

}
