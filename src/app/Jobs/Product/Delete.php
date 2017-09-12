<?php

namespace App\Jobs\Product;

use App\Models\Products as ProductModel;
USE App\Models\ProductsTags as ProductsTagsModel;
use App\Models\ProductsTags;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    /**
     * @var ProductsModel instance
     */
    protected $product;

    public function __construct(ProductModel $product)
    {
        $this->product = $product;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        if(\Auth::user()->id == $this->product->user_id)
        {
            ProductsTagsModel::where('product_id','=',$this->product->id)->delete();
            return $this->product->delete();
        }
    }
}
