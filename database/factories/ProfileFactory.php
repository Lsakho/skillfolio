<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->name(),
            'lastname' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'CC' => $this->faker->name(),
            'JC' => $this->faker->name(),
            'trainer' => $this->faker->name(),
            'status' => 'square'


        ];
    }
}
