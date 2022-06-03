<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            /* IDs */
            $table->string('id_sample')->primary();
            $table->string('id_medical_file')->nullable();
            $table->foreignId('id_sampler_lab')->nullable();
            $table->foreignId('id_sender_lab')->nullable();

            /* Attributes */
            $table->string('question_scaninfo')->nullable();
            $table->string('sampling_type')->nullable();
            $table->date('sampling_date')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('validation_date')->nullable();
            $table->string('unsubmitted_seq_gisaid')->nullable();

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
        Schema::dropIfExists('samples');
    }
}
