<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsTags extends Model
{
    protected $table = 'products-tags';

    protected $fillable = ['product_id','tag_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function tags()
    {
        return $this->belongsTo(Tags::class,'tag_id');
    }
    public function products()
    {
        return $this->belongsTo(Products::class,'product_id');
    }

}
