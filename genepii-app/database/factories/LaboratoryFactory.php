<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LaboratoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type_sampler = ['internal', 'external'];
        $type_sampler = $type_sampler[array_rand($type_sampler)];

        if ($type_sampler == 'internal') {
            $finess_sampler = null;
            $UF_sampler = $this->faker->unique()->randomNumber(2);
        } else {
            $finess_sampler = $this->faker->unique()->randomNumber(9);
            $UF_sampler = null;
        }

        return [
            'name_sender' => $this->faker->company(),
            'type_sampler' => $type_sampler,
            'finess_sampler' => $finess_sampler,
            'UF_sampler' => $UF_sampler,
            'postal_code_sampler' => $this->faker->randomNumber(5)
        ];
    }
}
