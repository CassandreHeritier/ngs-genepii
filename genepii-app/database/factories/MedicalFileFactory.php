<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id_patients =Patient::all()->pluck('id_patient')->all();

        return [
            'id_file' => $this->faker->unique()->numberBetween(0000000000, 9999999999),
            'id_patient' => $this->faker->randomElement($id_patients),
            'symptoms' => rand(0, 1),
            'flash_study' => rand(0, 1),
            'cluster' => rand(0, 1),
            // 'retour_etranger_14j' => rand(0, 1),
            'reinfection' => rand(0, 1),
            'immunosuppressed' => rand(0, 1),
            'serious_case' => rand(0, 1),
            'detection_survey' => rand(0, 1),
            'ac_treatment' => rand(0, 1),
            'abnormal_situation' => rand(0, 1),
            'no_indication' => 'info',
        ];
    }
}
