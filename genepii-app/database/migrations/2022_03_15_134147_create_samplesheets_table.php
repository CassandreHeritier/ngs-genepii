<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateSamplesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samplesheets', function (Blueprint $table) {
            /* IDs */
            $table->id('id_samplesheet');
            $table->string('id_seq_run');
            $table->string('id_sample');
            $table->string('id_plate');

            /* Attributes */
            $table->string('platewell')->nullable();
            $table->integer('lane')->nullable();
            $table->string('index_1')->nullable();
            $table->string('index_2')->nullable();
            $table->string('set_index')->nullable();
            $table->string('protocol')->nullable();
            $table->string('primers')->nullable();
            $table->string('sample_project')->nullable();
            $table->string('bioinfo_project')->nullable();

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
        Schema::dropIfExists('samplesheets');
    }
}
