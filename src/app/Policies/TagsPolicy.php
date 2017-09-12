<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Tags as TagsModel;


class TagsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function before(){
        return  true;
    }

    public function store(User $user, TagsModel $tag)
    {
        return true;
    }
}
