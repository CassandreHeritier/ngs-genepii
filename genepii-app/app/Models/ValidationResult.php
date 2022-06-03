<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidationResult extends Model
{
    use HasFactory;

    public function bioinfoRun()
    {
        return $this->belongsTo(BioinfoRun::class, 'id_bioinfo_run', 'id_bioinfo_run');
    }

    public function scopeFilter($query, array $filters)
    {        
        $query->when($filters['validationId'] ?? false, fn($query, $validationId) =>
            $query->where(fn($query) =>
                $query->where('id_validation', 'like', '%' . $validationId . '%')
            )
        );

        $query->when($filters['bioinfoRunId'] ?? false, fn($query, $bioinfoRunId) =>
            $query->where(fn($query) =>
                $query->where('id_bioinfo_run', 'like', '%' . $bioinfoRunId . '%')
            )
        );
    }
}
