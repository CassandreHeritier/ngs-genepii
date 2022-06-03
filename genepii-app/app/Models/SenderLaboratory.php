<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenderLaboratory extends Model
{
    use HasFactory;

    public function samples()
    {
        return $this->hasMany(Sample::class, 'id_sender_lab', 'id_sender_lab');
    }

    public function scopeFilter($query, array $filters)
    {        
        $query->when($filters['senderLabId'] ?? false, fn($query, $senderLabId) =>
            $query->where(fn($query) =>
                $query->where('id_sender_lab', 'like', '%' . $senderLabId . '%')
            )
        );

        $query->when($filters['nameSender'] ?? false, fn($query, $nameSender) =>
            $query->where(fn($query) =>
                $query->where('name_sender', 'like', '%' . $nameSender . '%')
            )
        );

        $query->when($filters['dptSender'] ?? false, fn($query, $dptSender) =>
            $query->where(fn($query) =>
                $query->where('department', 'like', '%' . $dptSender . '%')
            )
        );

        $query->when($filters['townSender'] ?? false, fn($query, $townSender) =>
            $query->where(fn($query) =>
                $query->where('town', 'like', '%' . $townSender . '%')
            )
        );

        $query->when($filters['mnemoidSender'] ?? false, fn($query, $mnemoidSender) =>
            $query->where(fn($query) =>
                $query->where('mnemoid', 'like', '%' . $mnemoidSender . '%')
            )
        );
    }
}
