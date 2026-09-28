<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';

    protected $fillable = [
        'sesi_presensi_id',
        'mahasantri_id',
        'waktu_presensi',
        'metode',
        'status',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'waktu_presensi' => 'datetime',
        ];
    }

    public function sesiPresensi()
    {
        return $this->belongsTo(SesiPresensi::class);
    }

    public function mahasantri()
    {
        return $this->belongsTo(Mahasantri::class);
    }
}