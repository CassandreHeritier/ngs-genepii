<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalFile extends Model
{
    use HasFactory;

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_patient', 'id_patient');
    }

    public function samples()
    {
        return $this->hasMany(Sample::class, 'id_medical_file', 'id_medical_file');
    }

    public function scopeFilter($query, array $filters)
    {        
        $query->when($filters['fileId'] ?? false, fn($query, $fileId) =>
            $query->where(fn($query) =>
                $query->where('id_medical_file', 'like', '%' . $fileId . '%')
            )
        );

        $query->when($filters['patientId'] ?? false, fn($query, $patientId) =>
            $query->where(fn($query) =>
                $query->where('id_patient', 'like', '%' . $patientId . '%')
            )
        );

        $query->when($filters['infoscan'] ?? false, fn($query, $infoscan) =>
            $query->where(fn($query) =>
                $query->where('infoscan', 'like', '%' . $infoscan . '%')
            )
        );

        $query->when($filters['infoband'] ?? false, fn($query, $infoband) =>
            $query->where(fn($query) =>
                $query->where('infoband', 'like', '%' . $infoband . '%')
            )
        );

        /* YES/NO columns */
        $query->when($filters['flash'] ?? false, fn($query, $flash) =>
            $query->where(fn($query) =>
                $query->where('flash_study', $flash)
            )
        );

        $query->when($filters['cluster'] ?? false, fn($query, $cluster) =>
            $query->where(fn($query) =>
                $query->where('cluster', $cluster)
            )
        );

        $query->when($filters['reinfection'] ?? false, fn($query, $reinfection) =>
            $query->where(fn($query) =>
                $query->where('reinfection', $reinfection)
            )
        );

        $query->when($filters['coinfection'] ?? false, fn($query, $coinfection) =>
            $query->where(fn($query) =>
                $query->where('coinfection', $coinfection)
            )
        );

        $query->when($filters['seriousCase'] ?? false, fn($query, $seriousCase) =>
            $query->where(fn($query) =>
                $query->where('serious_case', $seriousCase)
            )
        );

        $query->when($filters['epidemio'] ?? false, fn($query, $epidemio) =>
            $query->where(fn($query) =>
                $query->where('abnormal_situation', $epidemio)
            )
        );
        /* end */
        
        $query->when($filters['symptoms'] ?? false, fn($query, $symptoms) =>
            $query->where(fn($query) =>
                $query->where('symptoms', 'like', '%' . $symptoms . '%')
            )
        );

        $query->when($filters['sthcov'] ?? false, fn($query, $sthcov) =>
            $query->where(fn($query) =>
                $query->where('sthcov', 'like', '%' . $sthcov . '%')
            )
        );

        $query->when($filters['extract'] ?? false, fn($query, $extract) =>
            $query->where(fn($query) =>
                $query->where('extract', 'like', '%' . $extract . '%')
            )
        );

        $query->when($filters['ct'] ?? false, fn($query, $ct) =>
            $query->where(fn($query) =>
                $query->where('ct', 'like', '%' . $ct . '%')
            )
        );

        $query->when($filters['immunosuppressed'] ?? false, fn($query, $immunosuppressed) =>
            $query->where(fn($query) =>
                $query->where('immunosuppressed', 'like', '%' . $immunosuppressed . '%')
            )
        );

        $query->when($filters['detectionSurvey'] ?? false, fn($query, $detectionSurvey) =>
            $query->where(fn($query) =>
                $query->where('detection_survey', 'like', '%' . $detectionSurvey . '%')
            )
        );

        $query->when($filters['acFailure'] ?? false, fn($query, $acFailure) =>
            $query->where(fn($query) =>
                $query->where('ac_treatment_failure', 'like', '%' . $acFailure . '%')
            )
        );

        $query->when($filters['noIndication'] ?? false, fn($query, $noIndication) =>
            $query->where(fn($query) =>
                $query->where('no_indication', 'like', '%' . $noIndication . '%')
            )
        );
    }
}
