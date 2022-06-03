<x-title type="2">Résultat Nextclade {{ $nextclade_result->id_nextclade }}</x-title>

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
        <tr>
            <!-- <x-trow class="bs-checkbox">
                <x-checkbox id="{{ $nextclade_result->id_nextclade }}"/>
            </x-trow> -->
            <x-trow>{{ $nextclade_result->id_nextclade }}</x-trow>
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
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'nextclade-results']) }}">Retour aux résultats Nextclade</a>
    </x-slot>
</x-table>