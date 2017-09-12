<?php

namespace App\Jobs\Product;

use App\Models\Products as ProductsModel;
use App\Models\ProductsTags as ProductsTagsModel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\TagsProductsCountModel;

class Create implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    /** @var  string */
    protected $name;
    /** @var integer*/
    protected $user_id;
    /** @var  string */
    protected $description;
    /** @var  integer */
    protected $price;
    /** @var  array */
    protected $tags;



    public function __construct(array $data)
    {
        $this->name = array_get($data, 'prod_name');
        $this->user_id = array_get($data,'user_id');
        $this->description = array_get($data, 'prod_desc');
        $this->price = array_get($data, 'prod_price');
        $this->tags = array_get($data, 'tags');
    }


    public function handle()
    {

        $product = ProductsModel::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'user_id' => $this->user_id
        ]);

        $product_id = $product->id;
        if(isset($this->tags))
        {
            foreach($this->tags as $tag)
            {
                ProductsTagsModel::create([
                    'tag_id' => $tag,
                    'product_id' =>  $product_id
                ]);


            }
        }


    }
}
