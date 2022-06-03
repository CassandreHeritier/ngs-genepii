<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extraction extends Model
{
    use HasFactory;

    public function samples()
    {
        return $this->hasMany(Prelevement::class, 'id_sample', 'id_sample');
    }

    public function plates()
    {
        return $this->hasMany(Plaque::class, 'id_plate', 'id_plate');
    }

    public function scopeFilter($query, array $filters)
    {        
        $query->when($filters['plateId'] ?? false, fn($query, $plateId) =>
            $query->where(fn($query) =>
                $query->where('id_plate', 'like', '%' . $plateId . '%')
            )
        );

        $query->when($filters['sampleId'] ?? false, fn($query, $sampleId) =>
            $query->where(fn($query) =>
                $query->where('id_sample', 'like', '%' . $sampleId . '%')
            )
        );

        $query->when($filters['trackbc'] ?? false, fn($query, $trackbc) =>
            $query->where(fn($query) =>
                $query->where('track_bc', 'like', '%' . $trackbc . '%')
            )
        );

        $query->when($filters['tlabwareid'] ?? false, fn($query, $tlabwareid) =>
            $query->where(fn($query) =>
                $query->where('tlabware_id', 'like', '%' . $tlabwareid . '%')
            )
        );

        $query->when($filters['tpositionid'] ?? false, fn($query, $tpositionid) =>
            $query->where(fn($query) =>
                $query->where('tposition_id', 'like', '%' . $tpositionid . '%')
            )
        );

        $query->when($filters['tpositionbc'] ?? false, fn($query, $tpositionbc) =>
            $query->where(fn($query) =>
                $query->where('tposition_bc', 'like', '%' . $tpositionbc . '%')
            )
        );

        $query->when($filters['tstatutSummary'] ?? false, fn($query, $tstatutSummary) =>
            $query->where(fn($query) =>
                $query->where('tstatut_summary', 'like', '%' . $tstatutSummary . '%')
            )
        );

        $query->when($filters['tsumStateDescription'] ?? false, fn($query, $tsumStateDescription) =>
            $query->where(fn($query) =>
                $query->where('tsum_state_description', 'like', '%' . $tsumStateDescription . '%')
            )
        );

        $query->when($filters['tvolume'] ?? false, fn($query, $tvolume) =>
            $query->where(fn($query) =>
                $query->where('tvolume', 'like', '%' . $tvolume . '%')
            )
        );

        $query->when($filters['srackbc'] ?? false, fn($query, $srackbc) =>
            $query->where(fn($query) =>
                $query->where('srack_bc', 'like', '%' . $srackbc . '%')
            )
        );

        $query->when($filters['slabwareid'] ?? false, fn($query, $slabwareid) =>
            $query->where(fn($query) =>
                $query->where('slabware_id', 'like', '%' . $slabwareid . '%')
            )
        );

        $query->when($filters['spositionid'] ?? false, fn($query, $spositionid) =>
            $query->where(fn($query) =>
                $query->where('sposition_id', 'like', '%' . $spositionid . '%')
            )
        );

        $query->when($filters['spositionbc'] ?? false, fn($query, $spositionbc) =>
            $query->where(fn($query) =>
                $query->where('sposition_bc', 'like', '%' . $spositionbc . '%')
            )
        );

        $query->when($filters['actionDateTime'] ?? false, fn($query, $actionDateTime) =>
            $query->where(fn($query) =>
                $query->where('action_date_time', 'like', '%' . $actionDateTime . '%')
            )
        );

        $query->when($filters['username'] ?? false, fn($query, $username) =>
            $query->where(fn($query) =>
                $query->where('user_name', 'like', '%' . $username . '%')
            )
        );
    }
}
