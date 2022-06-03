<?php

namespace Database\Seeders;

use App\Models\BioinfoRun;
use App\Models\MedicalFile;
use App\Models\Extraction;
use App\Models\Laboratory;
use App\Models\Patient;
use App\Models\PipelineSet;
use App\Models\Plate;
use App\Models\Sample;
use App\Models\Samplesheet;
use App\Models\SequencingRun;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Patient::factory(20)->create();
        Laboratory::factory(3)->create();
        MedicalFile::factory(10)->create();
        Sample::factory(30)->create();
        Plate::factory(10)->create();
        Extraction::factory(40)->create();
        SequencingRun::factory(5)->create();
        Samplesheet::factory(30)->create();
        // NewSampleId::factory(30)->create();
        BioinfoRun::factory(3)->create();
        PipelineSet::factory(3)->create();
        // FastaSequence::factory(30)->create();
    }
}
