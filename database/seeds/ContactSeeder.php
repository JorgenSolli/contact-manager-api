<?php

use Illuminate\Database\Seeder;
use EcoOnline\ContactManagerApi\v1\Models\Contact;
use EcoOnline\UserApi\v1\Domain\User\Models\User as UserModel;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserModel::class, 50)->create()->each(function ($user) {
            // The "contacts" relation  need to exist
            $user->contacts()->save(factory(Contact::class)->make());
        });
    }
}
