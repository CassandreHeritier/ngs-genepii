<?php

namespace Database\Factories;

use App\Models\MedicalFile;
use App\Models\Sample;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SampleFactory extends Factory
{
    private function numSample($id_file)
    {
        $prefix = 1;
        $samples = Sample::all(); // TODO probleme de lifecycle, pas de prelevements encore crees

        foreach ($samples as $sample) {
            if ($sample->id_file == $id_file) {
                $prefix = 'un de plus';
            }
        }

        // return $id_file . $prefix;
        return $this->faker->unique()->numberBetween(0000000000, 9999999999);
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids_files = MedicalFile::all()->pluck('id_file')->all();
        $id_file = $this->faker->randomElement($ids_files);

        $id_sample=self::numSample($id_file);

        $ids_labos = Laboratory::all()->pluck('id')->all();

        $sampling_type = ['nasopharyngé', 'salivaire'];
        $sampling_type = $sampling_type[array_rand($sampling_type)];

        return [
            'id_sample' => $id_sample,
            'id_file' => $id_file,
            'id_laboratory' => $this->faker->randomElement($ids_labos),
            'question_scaninfo' => $id_file,
            'sampling_type' => $sampling_type,
            'sampling_date' => $this->faker->date(),
            'registration_date' => $this->faker->date(),
            'validation_date' => $this->faker->date(),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    /*public function configure()
    {
        return $this->afterCreating(function (Sample $sample) {
            $prefix = 01;
            $samples = Sample::all();

            foreach ($samples as $sam) {
                if ($sam->id_file == $sample->id_file) {
                    $prefix = 'un de plus';
                }
            }

            $sample->id_sample = $sample->id_file . $prefix;
        });
    }*/
}
