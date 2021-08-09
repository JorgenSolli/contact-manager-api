<?php

namespace EcoOnline\ContactManagerApi\Database\Seeders;

use EcoOnline\ContactManagerApi\v1\Models\Contact;
use Illuminate\Database\Seeder;
use EcoOnline\ContactManagerApi\v1\Models\User;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(1)
            ->has(Contact::factory()->count(30))
            ->create();
    }
}
