<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pangolin_results', function (Blueprint $table) {
            /* IDs */
            $table->id('id_pangolin');
            $table->string('id_bioinfo_run');

            /* Attributes */
            $table->string('lineage')->nullable();
            $table->float('conflict')->nullable();
            $table->float('ambiguity_score')->nullable();
            $table->string('scorpio_call')->nullable();
            $table->float('scorpio_support')->nullable();
            $table->float('scorpio_conflict')->nullable();
            $table->text('scorpio_notes')->nullable();
            $table->string('pangolin_version')->nullable();
            $table->string('pangolin_version_nb')->nullable();
            $table->string('scorpio_version')->nullable();
            $table->string('constellation_version')->nullable();
            $table->string('is_designated')->nullable();
            $table->string('qc_status')->nullable();
            $table->string('qc_notes')->nullable();
            $table->text('pangolin_note')->nullable();

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
        Schema::dropIfExists('pangolin_results');
    }
};
