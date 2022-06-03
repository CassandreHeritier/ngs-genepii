<?php

namespace Database\Factories;

use App\Models\Plate;
use App\Models\Sample;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtractionFactory extends Factory
{
    private static $index = 0;
    private static $prefix = 04;

    private function TPositionId($index) {
        $letters=range('A', 'H');
        $position=($index)%8;
        return $letters[$position] . (floor($index/8)+1);
    }

    private function SLabwareId($index) {
        if ($index != 0 && $index%32 == 0) self::$prefix++ ;
        return 'Sample_rack_32_' . self::$prefix;
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $index=self::$index++;

        $ids_samples = Sample::all()->pluck('id_sample')->all();
        $ids_plates = Plate::all()->pluck('id_plate')->all();

        $TStatusSummary=[0, 2, 16384];
        $TStatusSummary=$TStatusSummary[array_rand($TStatusSummary)];

        $TSumStateDescription=['Barcode warning', 'Correct pipetting', 'Pipetting error'];
        $TSumStateDescription=$TSumStateDescription[array_rand($TSumStateDescription)];

        return [
            'id_sample' => $this->faker->randomElement($ids_samples),
            'id_plate' => $this->faker->randomElement($ids_plates),
            'TrackBC' => $this->faker->unique()->randomNumber(6),
            'TLabwareId' => 'MTP_Dest2',
            'TPositionId' => self::TPositionId($index),
            'TPositionBC' => '----------',
            'TStatusSummary' => $TStatusSummary,
            'TSumStateDescription' => $TSumStateDescription,
            'TVolume' => 200,
            'SRackBC' => 'S' . $this->faker->unique()->randomNumber(7),
            'SLabwareId' => self::SLabwareId($index),
            'SPositionId' => '',
            'ActionDateTime' => $this->faker->date(),
            'UserName' => 'starlet'
        ];
    }
}
