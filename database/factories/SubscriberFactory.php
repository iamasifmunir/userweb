<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->name(),
            'website_id' => $this->faker->randomDigitNotZero(),
            'user_id' => $this->faker->randomDigitNotZero(),
        ];
    }
}
