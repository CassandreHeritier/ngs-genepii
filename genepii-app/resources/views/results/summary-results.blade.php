<x-title type="2">Table Résultats Summary</x-title>

<x-results.search />

<x-form.layout class="collapse show" id="objectCollapse" panel="true">
    <x-form.field>
        <x-form.label name="summaryId">Identifiant Summary :</x-form.label>
        <x-form.input name="summaryId" value="{{ request('summaryId') }}" placeholder="Numéro" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="bioinfoRunId">Numéro de run bioinfo :</x-form.label>
        <x-form.input name="bioinfoRunId" value="{{ request('bioinfoRunId') }}" placeholder="Identifiant" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="reference">Reference :</x-form.label>
        <x-form.input name="reference" value="{{ request('reference') }}" placeholder="reference" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="mean_depth">mean_depth :</x-form.label>
        <x-form.input name="mean_depth" value="{{ request('mean_depth') }}" placeholder="mean_depth" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="perc_cov">perc_cov :</x-form.label>
        <x-form.input name="perc_cov" value="{{ request('perc_cov') }}" placeholder="perc_cov" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="hasdp">hasdp :</x-form.label>
        <x-form.input name="hasdp" value="{{ request('hasdp') }}" placeholder="hasdp" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="hasposc">hasposc :</x-form.label>
        <x-form.input name="hasposc" value="{{ request('hasposc') }}" placeholder="hasposc" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="five_ten_perc">5-10% :</x-form.label>
        <x-form.input name="five_ten_perc" value="{{ request('five_ten_perc') }}" placeholder="" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ten_twenty_perc">10-20% :</x-form.label>
        <x-form.input name="ten_twenty_perc" value="{{ request('ten_twenty_perc') }}" placeholder="" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="twenty_fifty_perc">20-50% :</x-form.label>
        <x-form.input name="twenty_fifty_perc" value="{{ request('twenty_fifty_perc') }}" placeholder="" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="sum_varcount">sum_varcount :</x-form.label>
        <x-form.input name="sum_varcount" value="{{ request('sum_varcount') }}" placeholder="sum_varcount" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="coinf_maj_match">coinf_maj_match :</x-form.label>
        <x-form.input name="coinf_maj_match" value="{{ request('coinf_maj_match') }}" placeholder="coinf_maj_match" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="coinf_maj_common">coinf_maj_common :</x-form.label>
        <x-form.input name="coinf_maj_common" value="{{ request('coinf_maj_common') }}" placeholder="coinf_maj_common" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="coinf_maj_ratio">coinf_maj_ratio :</x-form.label>
        <x-form.input name="coinf_maj_ratio" value="{{ request('coinf_maj_ratio') }}" placeholder="coinf_maj_ratio" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="coinf_min_match">coinf_min_match :</x-form.label>
        <x-form.input name="coinf_min_match" value="{{ request('coinf_min_match') }}" placeholder="coinf_min_match" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="coinf_min_common">coinf_min_common :</x-form.label>
        <x-form.input name="coinf_min_common" value="{{ request('coinf_min_common') }}" placeholder="coinf_min_common" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="coinf_min_ratio">coinf_min_ratio :</x-form.label>
        <x-form.input name="coinf_min_ratio" value="{{ request('coinf_min_ratio') }}" placeholder="coinf_min_ratio" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nextclade_glims_ng">nextclade_glims_ng :</x-form.label>
        <x-form.input name="nextclade_glims_ng" value="{{ request('nextclade_glims_ng') }}" placeholder="nextclade_glims_ng" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nextclade_glims_sal">nextclade_glims_sal :</x-form.label>
        <x-form.input name="nextclade_glims_sal" value="{{ request('nextclade_glims_sal') }}" placeholder="nextclade_glims_sal" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nextclade_glims_lba">nextclade_glims_lba :</x-form.label>
        <x-form.input name="nextclade_glims_lba" value="{{ request('nextclade_glims_lba') }}" placeholder="nextclade_glims_lba" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nextclade_glims_naph">nextclade_glims_naph :</x-form.label>
        <x-form.input name="nextclade_glims_naph" value="{{ request('nextclade_glims_naph') }}" placeholder="nextclade_glims_naph" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nextclade_glims_trbr">nextclade_glims_trbr :</x-form.label>
        <x-form.input name="nextclade_glims_trbr" value="{{ request('nextclade_glims_trbr') }}" placeholder="nextclade_glims_trbr" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nextclade_glims_lung">nextclade_glims_lung :</x-form.label>
        <x-form.input name="nextclade_glims_lung" value="{{ request('nextclade_glims_lung') }}" placeholder="nextclade_glims_lung" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="nextclade_glims_other">nextclade_glims_other :</x-form.label>
        <x-form.input name="nextclade_glims_other" value="{{ request('nextclade_glims_other') }}" placeholder="nextclade_glims_other" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin_glims_ng">pangolin_glims_ng :</x-form.label>
        <x-form.input name="pangolin_glims_ng" value="{{ request('pangolin_glims_ng') }}" placeholder="pangolin_glims_ng" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin_glims_sal">pangolin_glims_sal :</x-form.label>
        <x-form.input name="pangolin_glims_sal" value="{{ request('pangolin_glims_sal') }}" placeholder="pangolin_glims_sal" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin_glims_lba">pangolin_glims_lba :</x-form.label>
        <x-form.input name="pangolin_glims_lba" value="{{ request('pangolin_glims_lba') }}" placeholder="pangolin_glims_lba" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin_glims_naph">pangolin_glims_naph :</x-form.label>
        <x-form.input name="pangolin_glims_naph" value="{{ request('pangolin_glims_naph') }}" placeholder="pangolin_glims_naph" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin_glims_trbr">pangolin_glims_trbr :</x-form.label>
        <x-form.input name="pangolin_glims_trbr" value="{{ request('pangolin_glims_trbr') }}" placeholder="pangolin_glims_trbr" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin_glims_lung">pangolin_glims_lung :</x-form.label>
        <x-form.input name="pangolin_glims_lung" value="{{ request('pangolin_glims_lung') }}" placeholder="pangolin_glims_lung" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="pangolin_glims_other">pangolin_glims_other :</x-form.label>
        <x-form.input name="pangolin_glims_other" value="{{ request('pangolin_glims_other') }}" placeholder="pangolin_glims_other" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ext_ng">ext_ng :</x-form.label>
        <x-form.input name="ext_ng" value="{{ request('ext_ng') }}" placeholder="ext_ng" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ext_sal">ext_sal :</x-form.label>
        <x-form.input name="ext_sal" value="{{ request('ext_sal') }}" placeholder="ext_sal" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ext_lba">ext_lba :</x-form.label>
        <x-form.input name="ext_lba" value="{{ request('ext_lba') }}" placeholder="ext_lba" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ext_naph">ext_naph :</x-form.label>
        <x-form.input name="ext_naph" value="{{ request('ext_naph') }}" placeholder="ext_naph" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ext_trbr">ext_trbr :</x-form.label>
        <x-form.input name="ext_trbr" value="{{ request('ext_trbr') }}" placeholder="ext_trbr" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ext_lung">ext_lung :</x-form.label>
        <x-form.input name="ext_lung" value="{{ request('ext_lung') }}" placeholder="ext_lung" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="ext_other">ext_other :</x-form.label>
        <x-form.input name="ext_other" value="{{ request('ext_other') }}" placeholder="ext_other" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="num_ng">num_ng :</x-form.label>
        <x-form.input name="num_ng" value="{{ request('num_ng') }}" placeholder="num_ng" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="num_sal">num_sal :</x-form.label>
        <x-form.input name="num_sal" value="{{ request('num_sal') }}" placeholder="num_sal" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="num_lba">num_lba :</x-form.label>
        <x-form.input name="num_lba" value="{{ request('num_lba') }}" placeholder="num_lba" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="num_naph">num_naph :</x-form.label>
        <x-form.input name="num_naph" value="{{ request('num_naph') }}" placeholder="num_naph" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="num_trbr">num_trbr :</x-form.label>
        <x-form.input name="num_trbr" value="{{ request('num_trbr') }}" placeholder="num_trbr" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="num_lung">num_lung :</x-form.label>
        <x-form.input name="num_lung" value="{{ request('num_lung') }}" placeholder="num_lung" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="num_other">num_other :</x-form.label>
        <x-form.input name="num_other" value="{{ request('num_other') }}" placeholder="num_other" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="variant_glims">variant_glims :</x-form.label>
        <x-form.input name="variant_glims" value="{{ request('variant_glims') }}" placeholder="variant_glims" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="fasta_path">fasta_path :</x-form.label>
        <x-form.input name="fasta_path" value="{{ request('fasta_path') }}" placeholder="fasta_path" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="comment_glims_ng">comment_glims_ng :</x-form.label>
        <x-form.input name="comment_glims_ng" value="{{ request('comment_glims_ng') }}" placeholder="comment_glims_ng" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="comment_glims_sal">comment_glims_sal :</x-form.label>
        <x-form.input name="comment_glims_sal" value="{{ request('comment_glims_sal') }}" placeholder="comment_glims_sal" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="comment_glims_lba">comment_glims_lba :</x-form.label>
        <x-form.input name="comment_glims_lba" value="{{ request('comment_glims_lba') }}" placeholder="comment_glims_lba" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="comment_glims_naph">comment_glims_naph :</x-form.label>
        <x-form.input name="comment_glims_naph" value="{{ request('comment_glims_naph') }}" placeholder="comment_glims_naph" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="comment_glims_trbr">comment_glims_trbr :</x-form.label>
        <x-form.input name="comment_glims_trbr" value="{{ request('comment_glims_trbr') }}" placeholder="comment_glims_trbr" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="comment_glims_lung">comment_glims_lung :</x-form.label>
        <x-form.input name="comment_glims_lung" value="{{ request('comment_glims_lung') }}" placeholder="comment_glims_lung" />
    </x-form.field>

    <x-form.field>
        <x-form.label name="comment_glims_other">comment_glims_other :</x-form.label>
        <x-form.input name="comment_glims_other" value="{{ request('comment_glims_other') }}" placeholder="comment_glims_other" />
    </x-form.field>

    <x-form.button>Rechercher</x-form.button>
    <x-form.button class="btn-secondary" type="button" onclick="window.location='/results/samplesheets'">Réinitialiser</x-form.button>
</x-form.layout>

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
        @foreach($summary_results as $summary_result)
            <tr>
                <!-- <x-trow class="bs-checkbox">
                    <x-checkbox id="{{ $summary_result->id_summary }}"/>
                </x-trow> -->
                <x-trow>
                    <a href="{{ route('results.show', ['id' => $summary_result->id_summary, 'tab' => 'summary-result']) }}">
                        {{ $summary_result->id_summary }}
                    </a>
                </x-trow>
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
        @endforeach
    </x-slot>
    <x-slot:links>
        {{ $summary_results->links() }}
    </x-slot>
</x-table>