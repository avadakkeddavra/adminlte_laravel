<?php

namespace App\Jobs\User;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\User as UserModel;
class Update implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    /** @var UserModel */
    protected $user;
    /** @var string */
    protected $name;
    /** @var integer */
    protected $role_id;
    public function __construct(UserModel $user,array $data)
    {
        $this->user = $user;

        $this->name = array_get($data, 'user_name', $this->user->name);
        $this->role_id = array_get($data, 'user_role', $this->user->role_id);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'name' => $this->name,
        ];
        if (\Auth::user()->can('change-role', $this->user)) {
            $data['role_id'] = $this->role_id;
        }
        return $this->user->update($data);
    }
}
