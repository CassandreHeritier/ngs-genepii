<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateMedicalFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_files', function (Blueprint $table) {
            /* IDs */
            $table->string('id_medical_file')->primary();
            $table->foreignId('id_patient')->nullable();

            /* Attributes */
            $table->string('infoscan', 700)->nullable();
            $table->string('infoband', 700)->nullable();
            $table->string('sthcov')->nullable();
            $table->string('extract')->nullable();
            $table->string('symptoms')->nullable();
            $table->string('flash_study')->nullable();
            $table->string('cluster')->nullable();
            $table->string('reinfection')->nullable();
            $table->string('ct')->nullable();
            $table->string('immunosuppressed')->nullable();
            $table->string('serious_case')->nullable();
            $table->string('detection_survey')->nullable();
            $table->string('ac_treatment')->nullable();
            $table->string('ac_treatment_failure')->nullable();
            $table->string('abnormal_situation')->nullable();
            $table->string('coinfection')->nullable();
            $table->string('no_indication')->nullable();
            $table->string('abroad_less_14d')->nullable();
            $table->string('other')->nullable();
            $table->string('sentinel_surv')->nullable();

            /* Timestamps */
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_files');
    }
}
