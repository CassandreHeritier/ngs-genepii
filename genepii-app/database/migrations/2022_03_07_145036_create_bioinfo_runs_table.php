<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateBioinfoRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bioinfo_runs', function (Blueprint $table) {
            /* IDs */
            $table->string('id_bioinfo_run')->primary();
            $table->string('id_seq_run')->nullable();
            $table->foreignId('id_set')->nullable();

            /* Attributes */
            $table->timestamp('bioinfo_run_date')->nullable();

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
        Schema::dropIfExists('bioinfo_runs');
    }
}
