<?php

namespace EcoOnline\ContactManagerApi\v1\Models;

use EcoOnline\ContactManagerApi\Database\Factories\UserFactory;
use EcoOnline\UserApi\v1\Domain\User\Models\User as UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends UserModel
{
    use HasFactory;

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
