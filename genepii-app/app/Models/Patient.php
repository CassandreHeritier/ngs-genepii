<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public function medicalFiles()
    {
        return $this->hasMany(MedicalFile::class, 'id_patient', 'id_patient');
    }

    public function scopeFilter($query, array $filters)
    {        
        $query->when($filters['patientId'] ?? false, fn($query, $patientId) =>
            $query->where(fn($query) =>
                $query->where('id_patient', 'like', '%' . $patientId . '%')
            )
        );

        $query->when($filters['birthDate1'] ?? false, fn($query, $birthDate1) =>
            $query->where(fn($query) =>
                $query->whereDate('birth_date', '>=', $birthDate1)
            )
        );

        $query->when($filters['birthDate2'] ?? false, fn($query, $birthDate2) =>
            $query->where(fn($query) =>
                $query->whereDate('birth_date', '<=', $birthDate2)
            )
        );

        /* TODO birth year ? */

        $query->when($filters['age'] ?? false, fn($query, $age) =>
            $query->where(fn($query) =>
                $query->where('age', 'like', '%' . $age . '%')
            )
        );

        $query->when($filters['ipp'] ?? false, fn($query, $ipp) =>
            $query->where(fn($query) =>
                $query->where('ipp', 'like', '%' . $ipp . '%')
            )
        );

        $query->when($filters['sex'] ?? false, fn($query, $sex) =>
            $query->where(fn($query) =>
                $query->where('sex', $sex)
            )
        );

        $query->when($filters['nbDoses'] ?? false, fn($query, $nbDoses) =>
            $query->where(fn($query) =>
                $query->where('nb_vaccine_doses', $nbDoses)
            )
        );

        /* First dose date */
        $query->when($filters['firstDose1'] ?? false, fn($query, $firstDose1) =>
            $query->where(fn($query) =>
                $query->whereDate('date_first_dose', '>=', $firstDose1)
            )
        );

        $query->when($filters['firstDose2'] ?? false, fn($query, $firstDose2) =>
            $query->where(fn($query) =>
                $query->whereDate('date_first_dose', '<=', $firstDose2)
            )
        );

        /* Second dose date */
        $query->when($filters['secondDose1'] ?? false, fn($query, $secondDose1) =>
            $query->where(fn($query) =>
                $query->whereDate('date_second_dose', '>=', $secondDose1)
            )
        );

        $query->when($filters['secondDose2'] ?? false, fn($query, $secondDose2) =>
            $query->where(fn($query) =>
                $query->whereDate('date_second_dose', '<=', $secondDose2)
            )
        );

        /* Last dose date */
        $query->when($filters['lastDose1'] ?? false, fn($query, $lastDose1) =>
            $query->where(fn($query) =>
                $query->whereDate('date_last_dose', '>=', $lastDose1)
            )
        );

        $query->when($filters['lastDose2'] ?? false, fn($query, $lastDose2) =>
            $query->where(fn($query) =>
                $query->whereDate('date_last_dose', '<=', $lastDose2)
            )
        );

        /* Vaccination */
        $query->when($filters['vaccineFailure'] ?? false, fn($query, $vaccineFailure) =>
            $query->where(fn($query) =>
                $query->where('vaccine_failure', $vaccineFailure)
            )
        );

        $query->when($filters['vaccinated'] ?? false, fn($query, $vaccinated) =>
            $query->where(fn($query) =>
                $query->where('vaccinated', $vaccinated)
            )
        );

        $query->when($filters['vaccination'] ?? false, fn($query, $vaccination) =>
            $query->where(fn($query) =>
                $query->where('vaccination', 'like', '%' . $vaccination . '%')
            )
        );

        $query->when($filters['completeScheme'] ?? false, fn($query, $completeScheme) =>
            $query->where(fn($query) =>
                $query->where('complete_scheme', $completeScheme)
            )
        );

        // $query->when($filters['township'] ?? false, fn($query, $township) =>
        //     $query->where(fn($query) =>
        //         $query->where('township_patient', 'like', '%' . $township . '%')
        //     )
        // );

        // $query->when($filters['postalCode'] ?? false, fn($query, $postalCode) =>
        //     $query->where(fn($query) =>
        //         $query->where('postal_code_patient2', 'like', '%' . $postalCode . '%')
        //     )
        // );
    }
}
