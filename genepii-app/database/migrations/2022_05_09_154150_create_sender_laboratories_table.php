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
        Schema::create('sender_laboratories', function (Blueprint $table) {
            /* ID */
            $table->bigInteger('id_sender_lab')->primary();

            /* Attributes */
            $table->string('name_sender')->nullable();
            $table->integer('department_sender')->nullable();
            $table->string('town_sender')->nullable();
            $table->string('mnemoid_sender')->nullable();

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
        Schema::dropIfExists('sender_laboratories');
    }
};
