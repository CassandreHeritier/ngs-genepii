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
        Schema::create('summary_results', function (Blueprint $table) {
            /* IDs */
            $table->id('id_summary');
            $table->string('id_bioinfo_run');

            /* Attributes */
            $table->string('reference')->nullable();
            $table->float('mean_depth')->nullable();
            $table->float('perc_cov')->nullable(); 
            $table->integer('hasdp')->nullable();
            $table->string('hasposc')->nullable();
            $table->integer('five_ten_perc')->nullable();
            $table->integer('ten_twenty_perc')->nullable();
            $table->integer('twenty_fifty_perc')->nullable();
            $table->integer('sum_varcount')->nullable();
            $table->string('coinf_maj_match')->nullable();
            $table->integer('coinf_maj_common')->nullable();
            $table->float('coinf_maj_ratio')->nullable();
            $table->string('coinf_min_match')->nullable();
            $table->integer('coinf_min_common')->nullable();
            $table->integer('coinf_min_ratio')->nullable();

            /* Nextclade */
            $table->string('nextclade_glims_ng')->nullable();
            $table->string('nextclade_glims_sal')->nullable();
            $table->string('nextclade_glims_lba')->nullable();
            $table->string('nextclade_glims_naph')->nullable();
            $table->string('nextclade_glims_trbr')->nullable();
            $table->string('nextclade_glims_lung')->nullable();
            $table->string('nextclade_glims_other')->nullable();

            /* Pangolin */
            $table->string('pangolin_glims_ng')->nullable();
            $table->string('pangolin_glims_sal')->nullable();
            $table->string('pangolin_glims_lba')->nullable();
            $table->string('pangolin_glims_naph')->nullable();
            $table->string('pangolin_glims_trbr')->nullable();
            $table->string('pangolin_glims_lung')->nullable();
            $table->string('pangolin_glims_other')->nullable();

            $table->string('ext_ng')->nullable();
            $table->string('ext_sal')->nullable();
            $table->string('ext_lba')->nullable();
            $table->string('ext_naph')->nullable();
            $table->string('ext_trbr')->nullable();
            $table->string('ext_lung')->nullable();
            $table->string('ext_other')->nullable();

            $table->string('num_ng')->nullable();
            $table->string('num_sal')->nullable();
            $table->string('num_lba')->nullable();
            $table->string('num_naph')->nullable();
            $table->string('num_trbr')->nullable();
            $table->string('num_lung')->nullable();
            $table->string('num_other')->nullable();

            $table->text('comment_glims_ng')->nullable();
            $table->text('comment_glims_sal')->nullable();
            $table->text('comment_glims_lba')->nullable();
            $table->text('comment_glims_naph')->nullable();
            $table->text('comment_glims_trbr')->nullable();
            $table->text('comment_glims_lung')->nullable();
            $table->text('comment_glims_other')->nullable();

            $table->string('variant_glims')->nullable();
            $table->string('fasta_path')->nullable();

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
        Schema::dropIfExists('summary_results');
    }
};
