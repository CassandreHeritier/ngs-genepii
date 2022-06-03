<x-title type="2">Table Résultats Nextclade</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <x-form.field>
        <x-form.label name="nextcladeId">Identifiant Nextclade :</x-form.label>
        <x-form.input name="nextcladeId" value="{{ request('nextcladeId') }}" placeholder="Numéro" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="bioinfoRunId">Numéro de run bioinfo :</x-form.label>
        <x-form.input name="bioinfoRunId" value="{{ request('bioinfoRunId') }}" placeholder="Identifiant" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nextcladePango">Nextclade_pango :</x-form.label>
        <x-form.input name="nextcladePango" value="{{ request('nextcladePango') }}" placeholder="nextclade_pango" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="qcOverallScore">qc_overallScore :</x-form.label>
        <x-form.input name="qcOverallScore" value="{{ request('qcOverallScore') }}" placeholder="qc_overallScore" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="qcOverallStatus">qc_overallStatus :</x-form.label>
        <x-form.input name="qcOverallStatus" value="{{ request('qcOverallStatus') }}" placeholder="qc_overallStatus" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="totalSubstitutions">totalSubstitutions :</x-form.label>
        <x-form.input name="totalSubstitutions" value="{{ request('totalSubstitutions') }}" placeholder="totalSubstitutions" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="totalDeletions">totalDeletions :</x-form.label>
        <x-form.input name="totalDeletions" value="{{ request('totalDeletions') }}" placeholder="totalDeletions" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="totalInsertions">totalInsertions :</x-form.label>
        <x-form.input name="totalInsertions" value="{{ request('totalInsertions') }}" placeholder="totalInsertions" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="totalFrameShifts">totalFrameShifts :</x-form.label>
        <x-form.input name="totalFrameShifts" value="{{ request('totalFrameShifts') }}" placeholder="totalFrameShifts" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="totalAminoacidSubstitutions">totalAminoacidSubstitutions :</x-form.label>
        <x-form.input name="totalAminoacidSubstitutions" value="{{ request('totalAminoacidSubstitutions') }}" placeholder="totalAminoacidSubstitutions" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="totalAminoacidDeletions">totalAminoacidDeletions :</x-form.label>
        <x-form.input name="totalAminoacidDeletions" value="{{ request('totalAminoacidDeletions') }}" placeholder="totalAminoacidDeletions" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="totalAminoacidInsertions">totalAminoacidInsertions :</x-form.label>
        <x-form.input name="totalAminoacidInsertions" value="{{ request('totalAminoacidInsertions') }}" placeholder="totalAminoacidInsertions" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="totalMissing">totalMissing :</x-form.label>
        <x-form.input name="totalMissing" value="{{ request('totalMissing') }}" placeholder="totalMissing" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="totalNonACGTNs">totalNonACGTNs :</x-form.label>
        <x-form.input name="totalNonACGTNs" value="{{ request('totalNonACGTNs') }}" placeholder="totalNonACGTNs" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="totalPcrPrimerChanges">totalPcrPrimerChanges :</x-form.label>
        <x-form.input name="totalPcrPrimerChanges" value="{{ request('totalPcrPrimerChanges') }}" placeholder="totalPcrPrimerChanges" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="substitutions">substitutions :</x-form.label>
        <x-form.input name="substitutions" value="{{ request('substitutions') }}" placeholder="substitutions" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="deletions">deletions :</x-form.label>
        <x-form.input name="deletions" value="{{ request('deletions') }}" placeholder="deletions" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nextclade_insertions">nextclade_insertions :</x-form.label>
        <x-form.input name="nextclade_insertions" value="{{ request('nextclade_insertions') }}" placeholder="nextclade_insertions" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="privateNucMutations_reversionSubstitutions">privateNucMutations_reversionSubstitutions :</x-form.label>
        <x-form.input name="privateNucMutations_reversionSubstitutions" value="{{ request('privateNucMutations_reversionSubstitutions') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="privateNucMutations_labeledSubstitutions">privateNucMutations_labeledSubstitutions :</x-form.label>
        <x-form.input name="privateNucMutations_labeledSubstitutions" value="{{ request('privateNucMutations_labeledSubstitutions') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="privateNucMutations_unlabeledSubstitutions">privateNucMutations_unlabeledSubstitutions :</x-form.label>
        <x-form.input name="privateNucMutations_unlabeledSubstitutions" value="{{ request('privateNucMutations_unlabeledSubstitutions') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="privateNucMutations_totalReversionSubstitutions">privateNucMutations_totalReversionSubstitutions :</x-form.label>
        <x-form.input name="privateNucMutations_totalReversionSubstitutions" value="{{ request('privateNucMutations_totalReversionSubstitutions') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="privateNucMutations_totalLabeledSubstitutions">privateNucMutations_totalLabeledSubstitutions :</x-form.label>
        <x-form.input name="privateNucMutations_totalLabeledSubstitutions" value="{{ request('privateNucMutations_totalLabeledSubstitutions') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="privateNucMutations_totalUnlabeledSubstitutions">privateNucMutations_totalUnlabeledSubstitutions :</x-form.label>
        <x-form.input name="privateNucMutations_totalUnlabeledSubstitutions" value="{{ request('privateNucMutations_totalUnlabeledSubstitutions') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="privateNucMutations_totalPrivateSubstitutions">privateNucMutations_totalPrivateSubstitutions :</x-form.label>
        <x-form.input name="privateNucMutations_totalPrivateSubstitutions" value="{{ request('privateNucMutations_totalPrivateSubstitutions') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="frameShifts">frameShifts :</x-form.label>
        <x-form.input name="frameShifts" value="{{ request('frameShifts') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="aaSubstitutions">aaSubstitutions :</x-form.label>
        <x-form.input name="aaSubstitutions" value="{{ request('aaSubstitutions') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="aaDeletions">aaDeletions :</x-form.label>
        <x-form.input name="aaDeletions" value="{{ request('aaDeletions') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="aaInsertions">aaInsertions :</x-form.label>
        <x-form.input name="aaInsertions" value="{{ request('aaInsertions') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="missing">missing :</x-form.label>
        <x-form.input name="missing" value="{{ request('missing') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="nonACGTNs">nonACGTNs :</x-form.label>
        <x-form.input name="nonACGTNs" value="{{ request('nonACGTNs') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="pcrPrimerChanges">pcrPrimerChanges :</x-form.label>
        <x-form.input name="pcrPrimerChanges" value="{{ request('pcrPrimerChanges') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="alignmentScore">alignmentScore :</x-form.label>
        <x-form.input name="alignmentScore" value="{{ request('alignmentScore') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="alignmentStart">alignmentStart :</x-form.label>
        <x-form.input name="alignmentStart" value="{{ request('alignmentStart') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="alignmentEnd">alignmentEnd :</x-form.label>
        <x-form.input name="alignmentEnd" value="{{ request('alignmentEnd') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_missingData_missingDataThreshold">qc_missingData_missingDataThreshold :</x-form.label>
        <x-form.input name="qc_missingData_missingDataThreshold" value="{{ request('qc_missingData_missingDataThreshold') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_missingData_score">qc_missingData_score :</x-form.label>
        <x-form.input name="qc_missingData_score" value="{{ request('qc_missingData_score') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_missingData_status">qc_missingData_status :</x-form.label>
        <x-form.input name="qc_missingData_status" value="{{ request('qc_missingData_status') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_missingData_totalMissing">qc_missingData_totalMissing :</x-form.label>
        <x-form.input name="qc_missingData_totalMissing" value="{{ request('qc_missingData_totalMissing') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_mixedSites_mixedSitesThreshold">qc_mixedSites_mixedSitesThreshold :</x-form.label>
        <x-form.input name="qc_mixedSites_mixedSitesThreshold" value="{{ request('qc_mixedSites_mixedSitesThreshold') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_mixedSites_score">qc_mixedSites_score :</x-form.label>
        <x-form.input name="qc_mixedSites_score" value="{{ request('qc_mixedSites_score') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_mixedSites_status">qc_mixedSites_status :</x-form.label>
        <x-form.input name="qc_mixedSites_status" value="{{ request('qc_mixedSites_status') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_mixedSites_totalMixedSites">qc_mixedSites_totalMixedSites :</x-form.label>
        <x-form.input name="qc_mixedSites_totalMixedSites" value="{{ request('qc_mixedSites_totalMixedSites') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_privateMutations_cutoff">qc_privateMutations_cutoff :</x-form.label>
        <x-form.input name="qc_privateMutations_cutoff" value="{{ request('qc_privateMutations_cutoff') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_privateMutations_excess">qc_privateMutations_excess :</x-form.label>
        <x-form.input name="qc_privateMutations_excess" value="{{ request('qc_privateMutations_excess') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_privateMutations_score">qc_privateMutations_score :</x-form.label>
        <x-form.input name="qc_privateMutations_score" value="{{ request('qc_privateMutations_score') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_privateMutations_status">qc_privateMutations_status :</x-form.label>
        <x-form.input name="qc_privateMutations_status" value="{{ request('qc_privateMutations_status') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_privateMutations_total">qc_privateMutations_total :</x-form.label>
        <x-form.input name="qc_privateMutations_total" value="{{ request('qc_privateMutations_total') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_snpClusters_clusteredSNPs">qc_snpClusters_clusteredSNPs :</x-form.label>
        <x-form.input name="qc_snpClusters_clusteredSNPs" value="{{ request('qc_snpClusters_clusteredSNPs') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_snpClusters_score">qc_snpClusters_score :</x-form.label>
        <x-form.input name="qc_snpClusters_score" value="{{ request('qc_snpClusters_score') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_snpClusters_status">qc_snpClusters_status :</x-form.label>
        <x-form.input name="qc_snpClusters_status" value="{{ request('qc_snpClusters_status') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_snpClusters_totalSNPs">qc_snpClusters_totalSNPs :</x-form.label>
        <x-form.input name="qc_snpClusters_totalSNPs" value="{{ request('qc_snpClusters_totalSNPs') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_frameShifts_frameShifts">qc_frameShifts_frameShifts :</x-form.label>
        <x-form.input name="qc_frameShifts_frameShifts" value="{{ request('qc_frameShifts_frameShifts') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_frameShifts_totalFrameShifts">qc_frameShifts_totalFrameShifts :</x-form.label>
        <x-form.input name="qc_frameShifts_totalFrameShifts" value="{{ request('qc_frameShifts_totalFrameShifts') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_frameShifts_frameShiftsIgnored">qc_frameShifts_frameShiftsIgnored :</x-form.label>
        <x-form.input name="qc_frameShifts_frameShiftsIgnored" value="{{ request('qc_frameShifts_frameShiftsIgnored') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_frameShifts_totalFrameShiftsIgnored">qc_frameShifts_totalFrameShiftsIgnored :</x-form.label>
        <x-form.input name="qc_frameShifts_totalFrameShiftsIgnored" value="{{ request('qc_frameShifts_totalFrameShiftsIgnored') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_frameShifts_score">qc_frameShifts_score :</x-form.label>
        <x-form.input name="qc_frameShifts_score" value="{{ request('qc_frameShifts_score') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_frameShifts_status">qc_frameShifts_status :</x-form.label>
        <x-form.input name="qc_frameShifts_status" value="{{ request('qc_frameShifts_status') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_stopCodons_stopCodons">qc_stopCodons_stopCodons :</x-form.label>
        <x-form.input name="qc_stopCodons_stopCodons" value="{{ request('qc_stopCodons_stopCodons') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_stopCodons_totalStopCodons">qc_stopCodons_totalStopCodons :</x-form.label>
        <x-form.input name="qc_stopCodons_totalStopCodons" value="{{ request('qc_stopCodons_totalStopCodons') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_stopCodons_score">qc_stopCodons_score :</x-form.label>
        <x-form.input name="qc_stopCodons_score" value="{{ request('qc_stopCodons_score') }}"/>
    </x-form.field>

    <x-form.field>
        <x-form.label name="qc_stopCodons_status">qc_stopCodons_status :</x-form.label>
        <x-form.input name="qc_stopCodons_status" value="{{ request('qc_stopCodons_status') }}"/>
    </x-form.field>
    
    <x-form.field>
        <x-form.label name="errors">errors :</x-form.label>
        <x-form.input name="errors" value="{{ request('errors') }}"/>
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/samplesheets'">Réinitialiser</x-form.button>
</x-form.layout>

<x-table class="nextcladeTable">
    <x-slot:thead>
        <!-- <x-thead class="bs-checkbox">
            <x-checkbox name="checkAll" />
            <form method="post" action="{{ route('results.download') }}">
                @csrf
                <button id="exportResults" disabled="true" type="submit" name="submit" value="export">
                    <i class="fa-solid fa-download"></i>
                </button>
            </form>
        </x-thead> -->

        <x-thead>Identifiant nextclade</x-thead>
        <x-thead>Numéro de run bioinfo</x-thead>
        <x-thead>nextclade_pango</x-thead>
        <x-thead>qc_overallScore</x-thead>
        <x-thead>qc_overallStatus</x-thead>
        <x-thead>totalSubstitutions</x-thead>
        <x-thead>totalDeletions</x-thead>
        <x-thead>totalInsertions</x-thead>
        <x-thead>totalFrameShifts</x-thead>
        <x-thead>totalAminoacidSubstitutions</x-thead>
        <x-thead>totalAminoacidDeletions</x-thead>
        <x-thead>totalAminoacidInsertions</x-thead>
        <x-thead>totalMissing</x-thead>
        <x-thead>totalNonACGTNs</x-thead>
        <x-thead>totalPcrPrimerChanges</x-thead>
        <x-thead>substitutions</x-thead>
        <x-thead>deletions</x-thead>
        <x-thead>nextclade_insertions</x-thead>
        <x-thead>privateNucMutations_reversionSubstitutions</x-thead>
        <x-thead>privateNucMutations_labeledSubstitutions</x-thead>
        <x-thead>privateNucMutations_unlabeledSubstitutions</x-thead>
        <x-thead>privateNucMutations_totalReversionSubstitutions</x-thead>
        <x-thead>privateNucMutations_totalLabeledSubstitutions</x-thead>
        <x-thead>privateNucMutations_totalUnlabeledSubstitutions</x-thead>
        <x-thead>privateNucMutations_totalPrivateSubstitutions</x-thead>
        <x-thead>frameShifts</x-thead>
        <x-thead>aaSubstitutions</x-thead>
        <x-thead>aaDeletions</x-thead>
        <x-thead>aaInsertions</x-thead>
        <x-thead>missing</x-thead>
        <x-thead>nonACGTNs</x-thead>
        <x-thead>pcrPrimerChanges</x-thead>
        <x-thead>alignmentScore</x-thead>
        <x-thead>alignmentStart</x-thead>
        <x-thead>alignmentEnd</x-thead>
        <x-thead>qc_missingData_missingDataThreshold</x-thead>
        <x-thead>qc_missingData_score</x-thead>
        <x-thead>qc_missingData_status</x-thead>
        <x-thead>qc_missingData_totalMissing</x-thead>
        <x-thead>qc_mixedSites_mixedSitesThreshold</x-thead>
        <x-thead>qc_mixedSites_score</x-thead>
        <x-thead>qc_mixedSites_status</x-thead>
        <x-thead>qc_mixedSites_totalMixedSites</x-thead>
        <x-thead>qc_privateMutations_cutoff</x-thead>
        <x-thead>qc_privateMutations_excess</x-thead>
        <x-thead>qc_privateMutations_score</x-thead>
        <x-thead>qc_privateMutations_status</x-thead>
        <x-thead>qc_privateMutations_total</x-thead>
        <x-thead>qc_snpClusters_clusteredSNPs</x-thead>
        <x-thead>qc_snpClusters_score</x-thead>
        <x-thead>qc_snpClusters_status</x-thead>
        <x-thead>qc_snpClusters_totalSNPs</x-thead>
        <x-thead>qc_frameShifts_frameShifts</x-thead>
        <x-thead>qc_frameShifts_totalFrameShifts</x-thead>
        <x-thead>qc_frameShifts_frameShiftsIgnored</x-thead>
        <x-thead>qc_frameShifts_totalFrameShiftsIgnored</x-thead>
        <x-thead>qc_frameShifts_score</x-thead>
        <x-thead>qc_frameShifts_status</x-thead>
        <x-thead>qc_stopCodons_stopCodons</x-thead>
        <x-thead>qc_stopCodons_totalStopCodons</x-thead>
        <x-thead>qc_stopCodons_score</x-thead>
        <x-thead>qc_stopCodons_status</x-thead>
        <x-thead>errors</x-thead>

    </x-slot>
    <x-slot:tbody>
        @foreach($nextclade_results as $nextclade_result)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $nextclade_result->id_nextclade }}"/>
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $nextclade_result->id_nextclade, 'tab' => 'nextclade-result']) }}">
                        {{ $nextclade_result->id_nextclade }}
                    </a>
                </x-trow>
                <x-trow>{{ $nextclade_result->id_bioinfo_run }}</x-trow>
                <x-trow>{{ $nextclade_result->nextclade_pango }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_overallScore }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_overallStatus }}</x-trow>
                <x-trow>{{ $nextclade_result->totalSubstitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->totalDeletions }}</x-trow>
                <x-trow>{{ $nextclade_result->totalInsertions }}</x-trow>
                <x-trow>{{ $nextclade_result->totalFrameShifts }}</x-trow>
                <x-trow>{{ $nextclade_result->totalAminoacidSubstitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->totalAminoacidDeletions }}</x-trow>
                <x-trow>{{ $nextclade_result->totalAminoacidInsertions }}</x-trow>
                <x-trow>{{ $nextclade_result->totalMissing }}</x-trow>
                <x-trow>{{ $nextclade_result->totalNonACGTNs }}</x-trow>
                <x-trow>{{ $nextclade_result->totalPcrPrimerChanges }}</x-trow>
                <x-trow>{{ $nextclade_result->substitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->deletions }}</x-trow>
                <x-trow>{{ $nextclade_result->nextclade_insertions }}</x-trow>
                <x-trow>{{ $nextclade_result->privateNucMutations_reversionSubstitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->privateNucMutations_labeledSubstitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->privateNucMutations_unlabeledSubstitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->privateNucMutations_totalReversionSubstitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->privateNucMutations_totalLabeledSubstitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->privateNucMutations_totalUnlabeledSubstitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->privateNucMutations_totalPrivateSubstitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->frameShifts }}</x-trow>
                <x-trow>{{ $nextclade_result->aaSubstitutions }}</x-trow>
                <x-trow>{{ $nextclade_result->aaDeletions }}</x-trow>
                <x-trow>{{ $nextclade_result->aaInsertions }}</x-trow>
                <x-trow>{{ $nextclade_result->missing }}</x-trow>
                <x-trow>{{ $nextclade_result->nonACGTNs }}</x-trow>
                <x-trow>{{ $nextclade_result->pcrPrimerChanges }}</x-trow>
                <x-trow>{{ $nextclade_result->alignmentScore }}</x-trow>
                <x-trow>{{ $nextclade_result->alignmentStart }}</x-trow>
                <x-trow>{{ $nextclade_result->alignmentEnd }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_missingData_missingDataThreshold }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_missingData_score }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_missingData_status }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_missingData_totalMissing }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_mixedSites_mixedSitesThreshold }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_mixedSites_score }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_mixedSites_status }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_mixedSites_totalMixedSites }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_privateMutations_cutoff }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_privateMutations_excess }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_privateMutations_score }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_privateMutations_status }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_privateMutations_total }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_snpClusters_clusteredSNPs }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_snpClusters_score }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_snpClusters_status }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_snpClusters_totalSNPs }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_frameShifts_frameShifts }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_frameShifts_totalFrameShifts }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_frameShifts_frameShiftsIgnored }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_frameShifts_totalFrameShiftsIgnored }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_frameShifts_score }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_frameShifts_status }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_stopCodons_stopCodons }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_stopCodons_totalStopCodons }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_stopCodons_score }}</x-trow>
                <x-trow>{{ $nextclade_result->qc_stopCodons_status }}</x-trow>
                <x-trow>{{ $nextclade_result->errors }}</x-trow>
            </tr>
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $nextclade_results->links() }}
    </x-slot>
</x-table>