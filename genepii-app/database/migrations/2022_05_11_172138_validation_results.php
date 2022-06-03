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
        Schema::create('validation_results', function (Blueprint $table) {
            /* IDs */
            $table->id('id_validation');
            $table->string('id_bioinfo_run');

            /* Attributes */
            $table->string('dp')->nullable();
            $table->string('val_varcount')->nullable();
            $table->float('rbmcoverage')->nullable();
            $table->float('spikecoverage')->nullable();
            $table->string('nextclade')->nullable();
            $table->string('pangolin')->nullable();
            $table->string('classmatch')->nullable();
            $table->string('classindex')->nullable();
            $table->string('classcomment')->nullable();
            $table->string('val_insertions')->nullable();
            $table->text('expectedprofile')->nullable();
            $table->text('likelyprofile')->nullable();
            $table->text('nocovsub')->nullable();
            $table->text('nocovins')->nullable();
            $table->text('missingsub')->nullable();
            $table->text('atypicsub')->nullable();
            $table->text('atypicindel')->nullable();
            $table->string('avisbio')->nullable();
            $table->string('result')->nullable();
            $table->text('commentary')->nullable();
            $table->string('error')->nullable();

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
        Schema::dropIfExists('validation_results');
    }
};
