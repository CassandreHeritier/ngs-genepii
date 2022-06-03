<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Samplesheet extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {        
        $query->when($filters['samplesheetId'] ?? false, fn($query, $samplesheetId) =>
            $query->where(fn($query) =>
                $query->where('id_samplesheet', 'like', '%' . $samplesheetId . '%')
            )
        );

        $query->when($filters['seqRunId'] ?? false, fn($query, $seqRunId) =>
            $query->where(fn($query) =>
                $query->where('id_seq_run', 'like', '%' . $seqRunId . '%')
            )
        );

        $query->when($filters['sampleId'] ?? false, fn($query, $sampleId) =>
            $query->where(fn($query) =>
                $query->where('id_sample', 'like', '%' . $sampleId . '%')
            )
        );

        $query->when($filters['plateId'] ?? false, fn($query, $plateId) =>
            $query->where(fn($query) =>
                $query->where('id_plate', 'like', '%' . $plateId . '%')
            )
        );

        $query->when($filters['platewell'] ?? false, fn($query, $platewell) =>
            $query->where(fn($query) =>
                $query->where('platewell', 'like', '%' . $platewell . '%')
            )
        );

        $query->when($filters['lane'] ?? false, fn($query, $lane) =>
            $query->where(fn($query) =>
                $query->where('lane', 'like', '%' . $lane . '%')
            )
        );

        $query->when($filters['index1'] ?? false, fn($query, $index1) =>
            $query->where(fn($query) =>
                $query->where('index_1', 'like', '%' . $index1 . '%')
            )
        );

        $query->when($filters['index2'] ?? false, fn($query, $index2) =>
            $query->where(fn($query) =>
                $query->where('index_2', 'like', '%' . $index2 . '%')
            )
        );

        $query->when($filters['setIndex'] ?? false, fn($query, $setIndex) =>
            $query->where(fn($query) =>
                $query->where('set_index', 'like', '%' . $setIndex . '%')
            )
        );

        $query->when($filters['protocol'] ?? false, fn($query, $protocol) =>
            $query->where(fn($query) =>
                $query->where('protocol', 'like', '%' . $protocol . '%')
            )
        );

        $query->when($filters['primers'] ?? false, fn($query, $primers) =>
            $query->where(fn($query) =>
                $query->where('primers', 'like', '%' . $primers . '%')
            )
        );

        $query->when($filters['sampleProject'] ?? false, fn($query, $sampleProject) =>
            $query->where(fn($query) =>
                $query->where('sample_project', 'like', '%' . $sampleProject . '%')
            )
        );

        $query->when($filters['bioinfoProject'] ?? false, fn($query, $bioinfoProject) =>
            $query->where(fn($query) =>
                $query->where('bioinfo_project', 'like', '%' . $bioinfoProject . '%')
            )
        );
    }
}
