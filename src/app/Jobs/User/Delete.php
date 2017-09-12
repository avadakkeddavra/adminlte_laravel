<?php

namespace App\Jobs\User;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\User as UserModel;
class Delete implements ShouldQueue
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

    /**
     *
     * @var string
    */
    protected $deleteType;


    public function __construct(UserModel $user, array $data)
    {
        $this->user = $user;
        $this->deleteType = array_get($data,'deleteType');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->deleteType == 'soft')
        {
            foreach($this->user->products as $product)
            {
                $product->delete();
            }
            return $this->user->delete();

        }elseif($this->deleteType == 'force'){

            return $this->user->forceDelete();
        }

    }
}
