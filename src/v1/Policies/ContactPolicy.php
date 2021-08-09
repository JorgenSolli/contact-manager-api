<?php

namespace EcoOnline\ContactManagerApi\v1\Policies;

use Illuminate\Auth\Access\Response;
use EcoOnline\ContactManagerApi\v1\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use EcoOnline\ContactManagerApi\v1\Models\Contact;

class ContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     * 
     *
     * @param  User  $user
     * @param  Contact  $contact
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Contact $contact)
    {
        return $user->id === $contact->user_id
            ? Response::allow()
            : Response::deny('You do not own this contact.');
    }
}
