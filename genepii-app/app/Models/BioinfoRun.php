<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BioinfoRun extends Model
{
    use HasFactory;

    public function nextcladeResults()
    {
        return $this->hasMany(NextcladeResult::class, 'id_bioinfo_run', 'id_bioinfo_run');
    }

    public function pangolinResults()
    {
        return $this->hasMany(PangolinResult::class, 'id_bioinfo_run', 'id_bioinfo_run');
    }

    public function summaryResults()
    {
        return $this->hasMany(SummaryResult::class, 'id_bioinfo_run', 'id_bioinfo_run');
    }

    public function validationResults()
    {
        return $this->hasMany(ValidationResult::class, 'id_bioinfo_run', 'id_bioinfo_run');
    }

    public function scopeFilter($query, array $filters)
    {        
        $query->when($filters['bioinfoRunId'] ?? false, fn($query, $bioinfoRunId) =>
            $query->where(fn($query) =>
                $query->where('id_bioinfo_run', 'like', '%' . $bioinfoRunId . '%')
            )
        );

        $query->when($filters['seqRunId'] ?? false, fn($query, $seqRunId) =>
            $query->where(fn($query) =>
                $query->where('id_seq_run', 'like', '%' . $seqRunId . '%')
            )
        );

        $query->when($filters['setId'] ?? false, fn($query, $setId) =>
            $query->where(fn($query) =>
                $query->where('id_set', 'like', '%' . $setId . '%')
            )
        );

        $query->when($filters['bioinfoRunDate'] ?? false, fn($query, $bioinfoRunDate) =>
            $query->where(fn($query) =>
                $query->where('bioinfo_run_date', 'like', '%' . $bioinfoRunDate . '%')
            )
        );
    }
}
