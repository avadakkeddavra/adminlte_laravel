<?php

namespace App\Jobs\User;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User as UserModel;
class Create implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $name;


    protected $email;

    protected $role;

    protected $password;


    public function __construct(array $data)
    {
        $this->name = array_get($data,'user_name');
        $this->email = array_get($data,'user_email');
        $this->role = array_get($data,'user_role');
        $this->password = array_get($data,'user_password');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return UserModel::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => \Hash::make($this->password),
            'role_id' => $this->role
        ]);
    }
}
