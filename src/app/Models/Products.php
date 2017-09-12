<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tags as TagsModel;
use App\Models\ProductsTags as ProductsTagsModel;

class Products extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'user_id',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    public function tags()
    {
        return $this->belongsToMany(TagsModel::class,'products-tags','product_id','tag_id');
    }
    public function products_tags()
    {
        return $this->hasMany(ProductsTags::class,'created_at','created_at');
    }


}
