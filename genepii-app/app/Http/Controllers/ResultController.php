<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BioinfoRun;
use App\Models\Sample;
use App\Models\MedicalFile;
use App\Models\Patient;
use App\Models\SamplerLaboratory;
use App\Models\SenderLaboratory;
use App\Models\Samplesheet;
use App\Models\Extraction;
use App\Models\NextcladeResult;
use App\Models\ValidationResult;
use App\Models\SummaryResult;
use App\Models\PangolinResult;

class ResultController extends Controller
{
    /**
     * Download resource from storage
     *
     * @param Request $request
     * @author Cassandre Héritier--Tellier
     */
    public function download(Request $request)
    {
        // launch script : download by SQL queries
        if ($request->submit == 'export') {
            // export data
        }
    }

    /**
     * Store resource into storage
     *
     * @param Request $request
     * @author Cassandre Héritier--Tellier
     */
    public function store(Request $request)
    {
        session([ 'value' => $request->value  ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $tab
     * @author Cassandre Héritier--Tellier
     */
    public function index($tab = null) {
        /* Display bioinfo runs */
        if ($tab === 'bioinfo-runs') {
            return view('results.index', [
                'bioinfo_runs' => BioinfoRun::latest()->filter(
                    request(
                        [
                            'bioinfoRunId',
                            'seqRunId',
                            'setId',
                            'bioinfoRunDate'
                        ]
                    )
                )->orderBy('id_bioinfo_run', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);
        
        /* Display extractions */
        } else if ($tab === 'extractions') {
            return view('results.index', [
                'extractions' => Extraction::latest()->filter(
                    request(
                        [
                            'plateId',
                            'sampleId',
                            'trackbc',
                            'tlabwareid',
                            'tpositionid',
                            'tpositionbc',
                            'tstatutSummary',
                            'tsumStateDescription',
                            'tvolume',
                            'srackbc',
                            'slabwareid',
                            'spositionid',
                            'spositionbc',
                            'actionDateTime',
                            'username'
                        ]
                    )
                )->orderBy('id_extraction', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);

        /* Display medical-files */
        } elseif ($tab === 'medical-files') {
            return view('results.index', [
                'medical_files' => MedicalFile::latest()->filter(
                    request(
                        [
                            'fileId',
                            'patientId',
                            'infoscan',
                            'infoband',
                            'flash',
                            'cluster',
                            'reinfection',
                            'coinfection',
                            'seriousCase',
                            'epidemio',
                            'symptoms',
                            'sthcov',
                            'extract',
                            'ct',
                            'immunosuppressed',
                            'detectionSurvey',
                            'acFailure',
                            'noIndication'
                        ]
                    )
                )->orderBy('id_medical_file', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);

        /* Display nextclade results */
        } elseif ($tab === 'nextclade-results') {
            return view('results.index', [
                'nextclade_results' => NextcladeResult::latest()->filter(
                    request(
                        [
                            'nextcladeId',
                            'bioinfoRunId',
                            'nextcladePango',
                            'qcOverallScore',
                            'qcOverallStatus',
                            'totalSubstitutions',
                            'totalDeletions',
                            'totalInsertions',
                            'totalFrameShifts',
                            'totalAminoacidSubstitutions',
                            'totalAminoacidInsertions',
                            'totalMissing',
                            'totalNonACGTNs',
                            'totalPcrPrimerChanges',
                            'substitutions',
                            'deletions',
                            'nextclade_insertions',
                            'privateNucMutations_reversionSubstitutions',
                            'privateNucMutations_labeledSubstitutions',
                            'privateNucMutations_unlabeledSubstitutions',
                            'privateNucMutations_totalReversionSubstitutions',
                            'privateNucMutations_totalLabeledSubstitutions',
                            'privateNucMutations_totalUnlabeledSubstitutions',
                            'privateNucMutations_totalPrivateSubstitutions',
                            'frameShifts',
                            'aaSubstitutions',
                            'aaDeletions',
                            'aaInsertions',
                            'missing',
                            'nonACGTNs',
                            'pcrPrimerChanges',
                            'alignmentScore',
                            'alignmentStart',
                            'alignmentEnd',
                            'qc_missingData_missingDataThreshold',
                            'qc_missingData_score',
                            'qc_missingData_status',
                            'qc_missingData_totalMissing',
                            'qc_mixedSites_mixedSitesThreshold',
                            'qc_mixedSites_score',
                            'qc_mixedSites_status',
                            'qc_mixedSites_totalMixedSites',
                            'qc_privateMutations_cutoff',
                            'qc_privateMutations_excess',
                            'qc_privateMutations_score',
                            'qc_privateMutations_status',
                            'qc_privateMutations_total',
                            'qc_snpClusters_clusteredSNPs',
                            'qc_snpClusters_score',
                            'qc_snpClusters_status',
                            'qc_snpClusters_totalSNPs',
                            'qc_frameShifts_frameShifts',
                            'qc_frameShifts_totalFrameShifts',
                            'qc_frameShifts_frameShiftsIgnored',
                            'qc_frameShifts_totalFrameShiftsIgnored',
                            'qc_frameShifts_score',
                            'qc_frameShifts_status',
                            'qc_stopCodons_stopCodons',
                            'qc_stopCodons_totalStopCodons',
                            'qc_stopCodons_score',
                            'qc_stopCodons_status',
                            'errors'
                        ]
                    )
                )->orderBy('id_nextclade', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);

        /* Display pangolin results */
        } elseif ($tab === 'pangolin-results') {
            return view('results.index', [
                'pangolin_results' => PangolinResult::latest()->filter(
                    request(
                        [
                            'pangolinId',
                            'bioinfoRunId',
                            'lineage',
                            'conflict',
                            'ambiguity_score',
                            'scorpio_call',
                            'scorpio_support',
                            'scorpio_conflict',
                            'scorpio_notes',
                            'pangolin_version',
                            'pangolin_version_nb',
                            'scorpio_version',
                            'constellation_version',
                            'is_designated',
                            'qc_status',
                            'qc_notes',
                            'pangolin_note'
                        ]
                    )
                )->orderBy('id_pangolin', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);

        /* Display patients */
        }  elseif ($tab === 'patients') {
            return view('results.index', [
                'patients' => Patient::latest()->filter(
                    request(
                        [
                            'patientId',
                            'birthDate1',
                            'birthDate2',
                            'age',
                            'ipp',
                            'sex',
                            'nbDoses',
                            'firstDose1',
                            'firstDose2',
                            'secondDose1',
                            'secondDose2',
                            'lastDose1',
                            'lastDose2',
                            'vaccineFailure',
                            'vaccinated',
                            'vaccination',
                            'completeScheme',
                            'township',
                            'postalCode'
                        ]
                    )
                )->orderBy('id_patient', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);

        /* Display sampler laboratories */
        } elseif ($tab === 'sampler-labs') {
            return view('results.index', [
                'sampler_laboratories' => SamplerLaboratory::latest()->filter(
                    request(
                        [
                            'laboId',
                            'nameSampler',
                            'finessSampler',
                            'ufSampler',
                            'typeSampler',
                            'postalCodeSampler'
                        ]
                    )
                )->orderBy('id_sampler_lab', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);

        /* Display samples */
        } elseif ($tab === 'samples') {
            return view('results.index', [
                'samples' => Sample::latest()->filter(
                        request(
                            [
                                'sampleId',
                                'fileId',
                                'labExp',
                                'samplingType',
                                'samplingDate1',
                                'samplingDate2',
                                'registrationDate1',
                                'registrationDate2',
                                'validationDate1',
                                'validationDate2'
                            ]
                        )
                )->orderBy('id_sample', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);

        /* Display samplesheets */
        } elseif ($tab === 'samplesheets') {
            return view('results.index', [
                'samplesheets' => Samplesheet::latest()->filter(
                    request(
                        [
                            'samplesheetId',
                            'seqRunId',
                            'sampleId',
                            'plateId',
                            'platewell',
                            'lane',
                            'index1',
                            'index2',
                            'setIndex',
                            'protocol',
                            'primers',
                            'sampleProject',
                            'bioinfoProject'                            
                        ]
                    )
                )->orderBy('id_samplesheet', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);
        
        /* Display sender laboratories */
        } elseif ($tab === 'sender-labs') {
            return view('results.index', [
                'sender_laboratories' => SenderLaboratory::latest()->filter(
                    request(
                        [
                            'senderLabID',
                            'nameSender',
                            'townSender',
                            'departmentSender',
                            'mnemoidSender'
                        ]
                    )
                )->orderBy('id_sender_lab', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);

        /* Display summary results */
        } elseif ($tab === 'summary-results') {
            return view('results.index', [
                'summary_results' => SummaryResult::latest()->filter(
                    request(
                        [
                            'summaryId',
                            'bioinfoRunId',
                            'reference',
                            'mean_depth',
                            'perc_cov',
                            'hasdp',
                            'hasposc',
                            'five_ten_perc',
                            'ten_twenty_perc',
                            'twenty_fifty_perc',
                            'sum_varcount',
                            'coinf_maj_match',
                            'coinf_maj_common',
                            'coinf_maj_ratio',
                            'coinf_min_match',
                            'coinf_min_common',
                            'coinf_min_ratio',
                            'nextclade_glims_ng',
                            'nextclade_glims_sal',
                            'nextclade_glims_lba',
                            'nextclade_glims_naph',
                            'nextclade_glims_trbr',
                            'nextclade_glims_lung',
                            'nextclade_glims_other',
                            'pangolin_glims_ng',
                            'pangolin_glims_sal',
                            'pangolin_glims_lba',
                            'pangolin_glims_naph',
                            'pangolin_glims_trbr',
                            'pangolin_glims_lung',
                            'pangolin_glims_other',
                            'ext_ng',
                            'ext_sal',
                            'ext_lba',
                            'ext_naph',
                            'ext_trbr',
                            'ext_lung',
                            'ext_other',
                            'num_ng',
                            'num_sal',
                            'num_lba',
                            'num_naph',
                            'num_trbr',
                            'num_lung',
                            'num_other',
                            'variant_glims',
                            'fasta_path',
                            'comment_glims_ng',
                            'comment_glims_sal',
                            'comment_glims_lba',
                            'comment_glims_naph',
                            'comment_glims_trbr',
                            'comment_glims_lung',
                            'comment_glims_other'
                        ]
                    )
                )->orderBy('id_summary', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);
        
        /* Display validation results */
        } elseif ($tab === 'validation-results') {
            return view('results.index', [
                'validation_results' => ValidationResult::latest()->filter(
                    request(
                        [
                            'validationId',
                            'bioinfoRunId',
                            'dp',
                            'val_varcount',
                            'rbmcoverage',
                            'spikecoverage',
                            'nextclade',
                            'pangolin',
                            'classmatch',
                            'classindex',
                            'classcomment',
                            'val_insertions',
                            'expectedprofile',
                            'likelyprofile',
                            'nocovsub',
                            'nocovins',
                            'missingsub',
                            'atypicsub',
                            'atypicindel',
                            'avisbio',
                            'result',
                            'commentary',
                            'error'
                        ]
                    )
                )->orderBy('id_validation', 'asc')->paginate(100)->withQueryString(),
                'tab' => $tab
            ]);
        
        /* Information page */
        } else {
            return view('results.index');
        }
    }

    /**
     * Show specific results
     * 
     * @param $tab
     * @param $id
     * @author Cassandre Héritier--Tellier
     */
    public function show($tab, $id) {
        if ($tab === 'bioinfo-run') {
            return view('results.show', [
                'bioinfo_run' => BioinfoRun::where('id_bioinfo_run', $id)->get()->first(),
                'tab' => 'bioinfo-run'
            ]);
        } else if ($tab === 'extraction') {
            return view('results.show', [
                'extraction' => Extraction::where('id_extraction', $id)->get()->first(),
                'tab' => 'extraction'
            ]);
        } else if ($tab === 'medical-file') {
            return view('results.show', [
                'medical_file' => MedicalFile::where('id_medical_file', $id)->get()->first(),
                'tab' => 'medical-file'
            ]);
        } else if ($tab === 'nextclade-result') {
            return view('results.show', [
                'nextclade_result' => NextcladeResult::where('id_nextclade', $id)->get()->first(),
                'tab' => 'nextclade-result'
            ]);
        } else if ($tab === 'pangolin-result') {
            return view('results.show', [
                'pangolin_result' => PangolinResult::where('id_pangolin', $id)->get()->first(),
                'tab' => 'pangolin-result'
            ]);
        } else if ($tab === 'patient') {
            return view('results.show', [
                'patient' => Patient::where('id_patient', $id)->get()->first(),
                'tab' => 'patient'
            ]);
        } else if ($tab === 'sampler-lab') {
            return view('results.show', [
                'sampler_lab' => SamplerLaboratory::where('id_sampler_lab', $id)->get()->first(),
                'tab' => 'sampler-lab'
            ]);
        } elseif ($tab === 'sample') {
            return view('results.show', [
                'sample' => Sample::where('id_sample', $id)->get()->first(),
                'tab' => 'sample'
            ]);
        } else if ($tab === 'samplesheet') {
            return view('results.show', [
                'samplesheet' => Samplesheet::where('id_samplesheet', $id)->get()->first(),
                'tab' => 'samplesheet'
            ]);
        } else if ($tab === 'sender-lab') {
            return view('results.show', [
                'sender_lab' => SenderLaboratory::where('id_sender_lab', $id)->get()->first(),
                'tab' => 'sender-lab'
            ]);
        } else if ($tab === 'summary-result') {
            return view('results.show', [
                'summary_result' => SummaryResult::where('id_summary', $id)->get()->first(),
                'tab' => 'summary-result'
            ]);
        } else if ($tab === 'validation-result') {
            return view('results.show', [
                'validation_result' => ValidationResult::where('id_validation', $id)->get()->first(),
                'tab' => 'validation-result'
            ]);
        } else {
            return view('results.show');
        }
    }
}
