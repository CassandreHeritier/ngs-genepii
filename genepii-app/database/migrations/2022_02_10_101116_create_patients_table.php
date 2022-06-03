<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            /* ID */
            $table->bigInteger('id_patient')->primary();

            /* Attributes */
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('birth_year')->nullable();
            $table->string('ipp')->nullable();
            // $table->string('sex')->nullable();
            // $table->integer('age')->nullable();
            // $table->string('township_patient')->nullable();
            // $table->string('postal_code_patient')->nullable();
            $table->integer('nb_vaccine_doses')->nullable();
            $table->string('vaccine_name')->nullable();
            $table->date('date_first_dose')->nullable();
            $table->date('date_second_dose')->nullable();
            $table->date('date_last_dose')->nullable();
            $table->string('vaccine_failure')->nullable();
            $table->string('vaccinated')->nullable();
            $table->string('vaccination')->nullable();
            $table->string('complete_scheme')->nullable();

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
        Schema::dropIfExists('patients');
    }
}
