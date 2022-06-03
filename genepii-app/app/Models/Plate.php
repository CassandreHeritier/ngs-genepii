<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    use HasFactory;

    public function extraction()
    {
        return $this->belongsTo(Extraction::class, 'id_plate', 'id_plate');
    }
}
