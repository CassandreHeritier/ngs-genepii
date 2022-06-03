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
        Schema::create('sampler_laboratories', function (Blueprint $table) {
            /* ID */
            $table->bigInteger('id_sampler_lab')->primary();

            /* Attributes */
            $table->string('name_sampler')->nullable();
            $table->string('postal_code_sampler')->nullable();
            $table->string('finess')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('UF')->nullable();

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
        Schema::dropIfExists('sampler_labos');
    }
};
