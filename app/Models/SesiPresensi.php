<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiPresensi extends Model
{
    use HasFactory;

    protected $table = 'sesi_presensi';

    protected $fillable = [
        'kegiatan_id',
        'nama_sesi',
        'waktu_mulai',
        'waktu_selesai',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'waktu_mulai' => 'datetime',
            'waktu_selesai' => 'datetime',
        ];
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function qrCode()
    {
        return $this->hasOne(QrCode::class);
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}