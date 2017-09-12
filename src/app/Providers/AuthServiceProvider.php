<?php

namespace App\Providers;

use App\Policies\ProductPolicy;
use App\Policies\TagsPolicy;
use App\Policies\UserPolicy;
use App\Models\Products;
use App\Models\Tags;
use App\Models\User;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Products::class => ProductPolicy::class,
        Tags::class => TagsPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
