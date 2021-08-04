<?php

namespace EcoOnline\ContactManagerApi\Database\Factories;

use Illuminate\Support\Str;
use EcoOnline\ContactManagerApi\v1\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->inique()->phone(),
            'linkedin_url' => $this->faker->url,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
        ];
    }
}
