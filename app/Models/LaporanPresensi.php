<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPresensi extends Model
{
    use HasFactory;

    protected $table = 'laporan_presensi';

    protected $fillable = [
        'kegiatan_id',
        'dibuat_oleh',
        'tanggal_laporan',
        'total_hadir',
        'total_izin',
        'total_alpa',
        'file_pdf',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_laporan' => 'date',
        ];
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}