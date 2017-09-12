<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
        public function before(User $user, $ability, $targetUser = null)
        {
            if(\Auth::user()->isAdmin())
            {
                return true;
            }
        }

        public function update()
        {
            return false;
        }
        public function destroy()
        {
            return false;
        }

        public function restore()
        {
            return false;
        }

        public function changeRole()
        {
            return false;
        }


}
