<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SamplerLaboratory extends Model
{
    use HasFactory;

    public function samples()
    {
        return $this->hasMany(Sample::class, 'id_sampler_lab', 'id_sampler_lab');
    }

    public function scopeFilter($query, array $filters)
    {        
        $query->when($filters['samplerLabId'] ?? false, fn($query, $samplerLabId) =>
            $query->where(fn($query) =>
                $query->where('id_sampler_lab', 'like', '%' . $samplerLabId . '%')
            )
        );

        $query->when($filters['nameSampler'] ?? false, fn($query, $nameSampler) =>
            $query->where(fn($query) =>
                $query->where('name_sampler', 'like', '%' . $nameSampler . '%')
            )
        );

        $query->when($filters['finessSampler'] ?? false, fn($query, $finessSampler) =>
            $query->where(fn($query) =>
                $query->where('finess', 'like', '%' . $finessSampler . '%')
            )
        );

        $query->when($filters['ufSampler'] ?? false, fn($query, $ufSampler) =>
            $query->where(fn($query) =>
                $query->where('UF', 'like', '%' . $ufSampler . '%')
            )
        );

        $query->when($filters['typeSampler'] ?? false, fn($query, $typeSampler) =>
            $query->where(fn($query) =>
                $query->where('type', 'like', '%' . $typeSampler . '%')
            )
        );

        $query->when($filters['postalCodeSampler'] ?? false, fn($query, $postalCodeSampler) =>
            $query->where(fn($query) =>
                $query->where('postal_code', 'like', '%' . $postalCodeSampler . '%')
            )
        );
    }
}
