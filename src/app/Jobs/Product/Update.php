<?php

namespace App\Jobs\Product;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Products as ProductsModel;
use App\Models\ProductsTags as ProductsTagsModel;
use App\Models\TagsProductsCountModel;
class Update implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /** @var  integer */
    protected $id;
    /** @var  string */
    protected $name;
    /** @var integer*/
    protected $user_id;
    /** @var  string */
    protected $description;

    protected $price;
    /** @var  array */
    protected $tags;


    protected $product;

    public function __construct(ProductsModel $product, $data = array())
    {
        $this->product = $product;

        $this->id = array_get($data,'id');
        $this->name = array_get($data, 'prod_name');
        $this->user_id = array_get($data,'user_id');
        $this->description = array_get($data, 'prod_desc');
        $this->price = array_get($data, 'prod_price');
        $this->tags = array_get($data, 'prod_tags');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        if(isset($this->tags))
        {
            ProductsTagsModel::where('product_id','=',$this->product->id)->delete();

            foreach($this->tags as $tag)
            {
                ProductsTagsModel::create([
                    'product_id' => $this->product->id,
                    'tag_id' => $tag,
                ]);


            }
        }

    }

}
