<x-title type="2">Résultat de Summary {{ $summary_result->id_summary }}</x-title>

<x-table class="summaryTable">
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
        <x-thead>Identifiant Summary</x-thead>
        <x-thead>Numéro de run bioinfo</x-thead>
        <x-thead>reference</x-thead>
        <x-thead>mean_depth</x-thead>
        <x-thead>perc_cov</x-thead>
        <x-thead>hasdp</x-thead>
        <x-thead>hasposc</x-thead>
        <x-thead>five_ten_perc</x-thead>
        <x-thead>ten_twenty_perc</x-thead>
        <x-thead>twenty_fifty_perc</x-thead>
        <x-thead>sum_varcount</x-thead>
        <x-thead>coinf_maj_match</x-thead>
        <x-thead>coinf_maj_common</x-thead>
        <x-thead>coinf_min_match</x-thead>
        <x-thead>coinf_min_common</x-thead>
        <x-thead>coinf_min_ratio</x-thead>
        <x-thead>nextclade_glims_ng</x-thead>
        <x-thead>nextclade_glims_sal</x-thead>
        <x-thead>nextclade_glims_lba</x-thead>
        <x-thead>nextclade_glims_naph</x-thead>
        <x-thead>nextclade_glims_trbr</x-thead>
        <x-thead>nextclade_glims_lung</x-thead>
        <x-thead>nextclade_glims_trbr</x-thead>
        <x-thead>nextclade_glims_other</x-thead>
        <x-thead>pangolin_glims_ng</x-thead>
        <x-thead>pangolin_glims_sal</x-thead>
        <x-thead>pangolin_glims_lba</x-thead>
        <x-thead>pangolin_glims_naph</x-thead>
        <x-thead>pangolin_glims_trbr</x-thead>
        <x-thead>pangolin_glims_lung</x-thead>
        <x-thead>pangolin_glims_other</x-thead>
        <x-thead>ext_ng</x-thead>
        <x-thead>ext_sal</x-thead>
        <x-thead>ext_lba</x-thead>
        <x-thead>ext_naph</x-thead>
        <x-thead>ext_trbr</x-thead>
        <x-thead>ext_lung</x-thead>
        <x-thead>ext_other</x-thead>
        <x-thead>num_ng</x-thead>
        <x-thead>num_sal</x-thead>
        <x-thead>num_lba</x-thead>
        <x-thead>num_naph</x-thead>
        <x-thead>num_trbr</x-thead>
        <x-thead>num_lung</x-thead>
        <x-thead>num_other</x-thead>
        <x-thead>variant_glims</x-thead>
        <x-thead>fasta_path</x-thead>
        <x-thead>comment_glims_ng</x-thead>
        <x-thead>comment_glims_sal</x-thead>
        <x-thead>comment_glims_lba</x-thead>
        <x-thead>comment_glims_naph</x-thead>
        <x-thead>comment_glims_trbr</x-thead>
        <x-thead>comment_glims_lung</x-thead>
        <x-thead>comment_glims_other</x-thead>
    </x-slot>

    <x-slot:tbody>
        <tr>
            <!-- <x-trow class="bs-checkbox">
                <x-checkbox id="{{ $summary_result->id_summary }}"/>
            </x-trow> -->
            <x-trow>{{ $summary_result->id_summary }}</x-trow>
            <x-trow>{{ $summary_result->id_bioinfo_run }}</x-trow>
            <x-trow>{{ $summary_result->reference }}</x-trow>
            <x-trow>{{ $summary_result->mean_depth }}</x-trow>
            <x-trow>{{ $summary_result->perc_cov }}</x-trow>
            <x-trow>{{ $summary_result->hasdp }}</x-trow>
            <x-trow>{{ $summary_result->hasposc }}</x-trow>
            <x-trow>{{ $summary_result->five_ten_perc }}</x-trow>
            <x-trow>{{ $summary_result->ten_twenty_perc }}</x-trow>
            <x-trow>{{ $summary_result->twenty_fifty_perc }}</x-trow>
            <x-trow>{{ $summary_result->sum_varcount }}</x-trow>
            <x-trow>{{ $summary_result->coinf_maj_match }}</x-trow>
            <x-trow>{{ $summary_result->coinf_maj_common }}</x-trow>
            <x-trow>{{ $summary_result->coinf_maj_ratio }}</x-trow>
            <x-trow>{{ $summary_result->coinf_min_match }}</x-trow>
            <x-trow>{{ $summary_result->coinf_min_common }}</x-trow>
            <x-trow>{{ $summary_result->coinf_min_ratio }}</x-trow>
            <x-trow>{{ $summary_result->nextclade_glims_ng }}</x-trow>
            <x-trow>{{ $summary_result->nextclade_glims_sal }}</x-trow>
            <x-trow>{{ $summary_result->nextclade_glims_lba }}</x-trow>
            <x-trow>{{ $summary_result->nextclade_glims_naph }}</x-trow>
            <x-trow>{{ $summary_result->nextclade_glims_trbr }}</x-trow>
            <x-trow>{{ $summary_result->nextclade_glims_lung }}</x-trow>
            <x-trow>{{ $summary_result->nextclade_glims_other }}</x-trow>
            <x-trow>{{ $summary_result->pangolin_glims_ng }}</x-trow>
            <x-trow>{{ $summary_result->pangolin_glims_sal }}</x-trow>
            <x-trow>{{ $summary_result->pangolin_glims_lba }}</x-trow>
            <x-trow>{{ $summary_result->pangolin_glims_naph }}</x-trow>
            <x-trow>{{ $summary_result->pangolin_glims_trbr }}</x-trow>
            <x-trow>{{ $summary_result->pangolin_glims_lung }}</x-trow>
            <x-trow>{{ $summary_result->pangolin_glims_other }}</x-trow>
            <x-trow>{{ $summary_result->ext_ng }}</x-trow>
            <x-trow>{{ $summary_result->ext_sal }}</x-trow>
            <x-trow>{{ $summary_result->ext_lba }}</x-trow>
            <x-trow>{{ $summary_result->ext_naph }}</x-trow>
            <x-trow>{{ $summary_result->ext_trbr }}</x-trow>
            <x-trow>{{ $summary_result->ext_lung }}</x-trow>
            <x-trow>{{ $summary_result->ext_other }}</x-trow>
            <x-trow>{{ $summary_result->num_ng }}</x-trow>
            <x-trow>{{ $summary_result->num_sal }}</x-trow>
            <x-trow>{{ $summary_result->num_lba }}</x-trow>
            <x-trow>{{ $summary_result->num_naph }}</x-trow>
            <x-trow>{{ $summary_result->num_trbr }}</x-trow>
            <x-trow>{{ $summary_result->num_lung }}</x-trow>
            <x-trow>{{ $summary_result->num_other }}</x-trow>
            <x-trow>{{ $summary_result->variant_glims }}</x-trow>
            <x-trow>{{ $summary_result->fasta_path }}</x-trow>
            <x-trow>{{ $summary_result->comment_glims_ng }}</x-trow>
            <x-trow>{{ $summary_result->comment_glims_sal }}</x-trow>
            <x-trow>{{ $summary_result->comment_glims_lba }}</x-trow>
            <x-trow>{{ $summary_result->comment_glims_naph }}</x-trow>
            <x-trow>{{ $summary_result->comment_glims_trbr }}</x-trow>
            <x-trow>{{ $summary_result->comment_glims_lung }}</x-trow>
            <x-trow>{{ $summary_result->comment_glims_other }}</x-trow>
        </tr>
    </x-slot>
    <x-slot:links>
        <a href="{{ route('results', ['tab' => 'summary-results']) }}">Retour aux résultats de Summary</a>
    </x-slot>
</x-table>