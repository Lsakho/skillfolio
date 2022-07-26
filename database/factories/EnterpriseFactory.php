<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EnterpriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,    
            'zip' => $this->faker->postcode,   
            'city' => $this->faker->word,
            'contact_person' => $this->faker->name
            
        ];
    }
}
