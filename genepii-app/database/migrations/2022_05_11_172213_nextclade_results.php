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
        Schema::create('nextclade_results', function (Blueprint $table) {
            /* IDs */
            $table->id('id_nextclade');
            $table->string('id_bioinfo_run');

            /* Attributes */
            $table->string('clade')->nullable();
            $table->string('nextclade_pango')->nullable();
            $table->float('qc_overallScore')->nullable();
            $table->string('qc_overallStatus')->nullable();
            $table->integer('totalSubstitutions')->nullable();
            $table->integer('totalDeletions')->nullable();
            $table->integer('totalInsertions')->nullable();
            $table->integer('totalFrameShifts')->nullable();
            $table->integer('totalAminoacidSubstitutions')->nullable();
            $table->integer('totalAminoacidDeletions')->nullable();
            $table->integer('totalAminoacidInsertions')->nullable();
            $table->integer('totalMissing')->nullable();
            $table->integer('totalNonACGTNs')->nullable();
            $table->integer('totalPcrPrimerChanges')->nullable();
            $table->text('substitutions')->nullable();
            $table->text('deletions')->nullable();
            $table->text('nextclade_insertions')->nullable();
            $table->text('privateNucMutations_reversionSubstitutions')->nullable();
            $table->text('privateNucMutations_labeledSubstitutions')->nullable();
            $table->text('privateNucMutations_unlabeledSubstitutions')->nullable();
            $table->integer('privateNucMutations_totalReversionSubstitutions')->nullable();
            $table->integer('privateNucMutations_totalLabeledSubstitutions')->nullable();
            $table->integer('privateNucMutations_totalUnlabeledSubstitutions')->nullable();
            $table->integer('privateNucMutations_totalPrivateSubstitutions')->nullable();
            $table->text('frameShifts')->nullable();
            $table->text('aaSubstitutions')->nullable();
            $table->text('aaDeletions')->nullable();
            $table->text('aaInsertions')->nullable();
            $table->text('missing')->nullable();
            $table->text('nonACGTNs')->nullable();
            $table->text('pcrPrimerChanges')->nullable();
            $table->integer('alignmentScore')->nullable();
            $table->integer('alignmentStart')->nullable();
            $table->integer('alignmentEnd')->nullable();
            $table->integer('qc_missingData_missingDataThreshold')->nullable();
            $table->float('qc_missingData_score')->nullable();
            $table->string('qc_missingData_status')->nullable();
            $table->integer('qc_missingData_totalMissing')->nullable();
            $table->integer('qc_mixedSites_mixedSitesThreshold')->nullable();
            $table->integer('qc_mixedSites_score')->nullable();
            $table->string('qc_mixedSites_status')->nullable();
            $table->integer('qc_mixedSites_totalMixedSites')->nullable();
            $table->integer('qc_privateMutations_cutoff')->nullable();
            $table->integer('qc_privateMutations_excess')->nullable();
            $table->float('qc_privateMutations_score')->nullable();
            $table->string('qc_privateMutations_status')->nullable();
            $table->string('qc_privateMutations_total')->nullable();
            $table->string('qc_snpClusters_clusteredSNPs')->nullable();
            $table->integer('qc_snpClusters_score')->nullable();
            $table->string('qc_snpClusters_status')->nullable();
            $table->integer('qc_snpClusters_totalSNPs')->nullable();
            $table->string('qc_frameShifts_frameShifts')->nullable();
            $table->integer('qc_frameShifts_totalFrameShifts')->nullable();
            $table->string('qc_frameShifts_frameShiftsIgnored')->nullable();
            $table->integer('qc_frameShifts_totalFrameShiftsIgnored')->nullable();
            $table->integer('qc_frameShifts_score')->nullable();
            $table->string('qc_frameShifts_status')->nullable();
            $table->string('qc_stopCodons_stopCodons')->nullable();
            $table->integer('qc_stopCodons_totalStopCodons')->nullable();
            $table->integer('qc_stopCodons_score')->nullable();
            $table->string('qc_stopCodons_status')->nullable();
            $table->string('nextclade_errors')->nullable();
            
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
        Schema::dropIfExists('nextclade_results');
    }
};
