<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'company' => $this->faker->company(),
           'email' => $this->faker->email(),
           'logo' => $this->faker->imageUrl(100, 100, 'animals', true),
           'addres' => $this->faker->secondaryAddress(),
        ];
    }
}
