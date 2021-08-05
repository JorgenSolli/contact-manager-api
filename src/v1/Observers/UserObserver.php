<?php

namespace EcoOnline\ContactManagerApi\v1\Observers;

use EcoOnline\ContactManagerApi\v1\Models\User;

class UserObserver
{
    /**
     * Handle the user "deleted" event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $user->contacts()->delete();
    }
}
