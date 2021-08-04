<?php

namespace EcoOnline\ContactManagerApi\v1\Models;

use EcoOnline\UserApi\v1\Domain\User\Models\User as UserModel;

class User extends UserModel
{
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
