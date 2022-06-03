<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    public function medicalFile()
    {
        return $this->belongsTo(MedicalFile::class, 'id_medical_file', 'id_medical_file');
    }

    public function senderLab()
    {
        return $this->belongsTo(SenderLaboratory::class, 'id_sender_lab', 'id_sender_lab');
    }

    public function samplerLab()
    {
        return $this->belongsTo(SamplerLaboratory::class, 'id_sampler_lab', 'id_sampler_lab');
    }

    public function extraction()
    {
        return $this->belongsTo(Extraction::class, 'id_sample', 'id_sample');
    }

    // protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {        
        $query->when($filters['sampleId'] ?? false, fn($query, $sampleId) =>
            $query->where(fn($query) =>
                $query->where('id_sample', 'like', '%' . $sampleId . '%')
            )
        );

        $query->when($filters['fileId'] ?? false, fn($query, $fileId) =>
            $query->where(fn($query) =>
                $query->where('id_medical_file', 'like', '%' . $fileId . '%')
            )
        );

        $query->when($filters['labExp'] ?? false, fn($query, $labExp) =>
            $query->whereHas('senderLab', fn($query) =>
                $query->where('name_sender', 'like', '%' . $labExp . '%')
            )
        );

        $query->when($filters['samplingType'] ?? false, fn($query, $samplingType) =>
            $query->where(fn($query) =>
                $query->where('sampling_type', 'like', '%' . $samplingType . '%')
            )
        );

        $query->when($filters['samplingDate1'] ?? false, fn($query, $samplingDate1) =>
            $query->where(fn($query) =>
                $query->whereDate('sampling_date', '>=', $samplingDate1)
            )
        );

        $query->when($filters['samplingDate2'] ?? false, fn($query, $samplingDate2) =>
            $query->where(fn($query) =>
                $query->whereDate('sampling_date', '<=', $samplingDate2)
            )
        );

        $query->when($filters['registrationDate1'] ?? false, fn($query, $registrationDate1) =>
            $query->where(fn($query) =>
                $query->whereDate('registration_date', '>=', $registrationDate1)
            )
        );

        $query->when($filters['registrationDate2'] ?? false, fn($query, $registrationDate2) =>
            $query->where(fn($query) =>
                $query->whereDate('registration_date', '<=', $registrationDate2)
            )
        );

        $query->when($filters['validationDate1'] ?? false, fn($query, $validationDate1) =>
            $query->where(fn($query) =>
                $query->whereDate('validation_date', '>=', $validationDate1)
            )
        );

        $query->when($filters['validationDate2'] ?? false, fn($query, $validationDate2) =>
            $query->where(fn($query) =>
                $query->whereDate('validation_date', '<=', $validationDate2)
            )
        );
    }
}
