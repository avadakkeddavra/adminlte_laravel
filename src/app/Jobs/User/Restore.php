<?php

namespace App\Jobs\User;

use App\Models\Products;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\User as UserModel;
use App\Models\Products as ProductsModel;
class Restore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    /**
     *
     * @var UserModel instance
    */
    protected $user;

    public function __construct(UserModel $user, array $data)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $products = Products::where('user_id','=',$this->user->id)->withTrashed()->get();
        foreach ($products as $product)
        {
            $product->restore();
        }

         $this->user->restore();

    }
}
