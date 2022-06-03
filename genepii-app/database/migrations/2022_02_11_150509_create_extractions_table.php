<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateExtractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extractions', function (Blueprint $table) {
            /* IDs */
            $table->id('id_extraction'); // id by line
            $table->string('id_plate')->nullable();
            $table->string('id_sample');

            /* Attributes */
            $table->integer('record_id'); // number of well
            $table->string('track_bc')->nullable();
            $table->string('tlabware_id')->nullable();
            $table->string('tposition_id')->nullable();
            $table->string('tposition_bc')->nullable();
            $table->integer('tstatus_summary')->nullable();
            $table->string('tsum_state_description')->nullable();
            $table->integer('tvolume')->nullable();
            $table->string('srack_bc')->nullable();
            $table->string('slabware_id')->nullable();
            $table->integer('sposition_id')->nullable();
            $table->timestamp('action_date_time')->nullable();
            $table->string('user_name')->nullable();

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
        Schema::dropIfExists('extractions');
    }
}
