<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sex = rand(0, 1) ? 'male' : 'female';
        $vaccination = ['aucune', '1 dose', '2 doses', '3 doses'];
        $type_vaccin = ['Pfizer', 'Astrazeneca'];

        $birth = date_create($this->faker->date());
        $now = date_create(now());
        $age = date_diff($birth, $now)->format('%y');

        $vaccination = $vaccination[array_rand($vaccination)];

        if ($vaccination == 'aucune') {
            $date_dose_1 = null;
            $date_dose_2 = null;
            $date_dose_3 = null;
        } else if ($vaccination == '1 dose') {
            $date_dose_1 = $this->faker->date();
            $date_dose_2 = null;
            $date_dose_3 = null;
        } else if ($vaccination == '2 doses') {
            $date_dose_1 = $this->faker->date();
            $date_dose_2 = $this->faker->date();
            $date_dose_3 = null;
        } else if ($vaccination == '3 doses') {
            $date_dose_1 = $this->faker->date();
            $date_dose_2 = $this->faker->date();
            $date_dose_3 = $this->faker->date();
        }

        return [
            'id_patient' => $this->faker->unique()->numberBetween(0000000000, 9999999999),
            'birth_date' => $birth,
            'postal_code1' => $this->faker->unique()->randomNumber(5),
            'age' => $age,
            'sex' => $sex,
            'nb_vaccine_doses' => $vaccination,
            'vaccine_name' => $type_vaccin[array_rand($type_vaccin)],
            'date_first_dose' => $date_dose_1,
            'date_second_dose' => $date_dose_2,
            'date_last_dose' => $date_dose_3,
        ];
    }
}
