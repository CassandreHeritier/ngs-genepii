<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_plate' => 'Pl' . $this->faker->unique()->randomNumber(3)
        ];
    }
}
