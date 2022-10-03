<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->url,
            'subs_count' => $this->faker->randomDigitNotZero(),
            'user_id' => $this->faker->randomDigitNotZero(),
        ];
    }
}
