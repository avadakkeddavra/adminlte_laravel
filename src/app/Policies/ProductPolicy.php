<?php

namespace App\Policies;

use App\Models\Products;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Products as ProductModel;
use App\Models\User as UserModel;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function before(){
        return true;
    }


    public function store()
    {
        return true;
    }

    public function destroy(UserModel $user, ProductModel $product)
    {
        return $product->user_id == $user->id;
    }
    public function update(UserModel $user, ProductModel $product)
    {
        return $product->user_id == $user->id;
    }
}
