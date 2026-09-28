<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    protected $table = 'qr_codes';

    protected $fillable = [
        'sesi_presensi_id',
        'kode',
        'berlaku_mulai',
        'berlaku_sampai',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'berlaku_mulai' => 'datetime',
            'berlaku_sampai' => 'datetime',
        ];
    }

    public function sesiPresensi()
    {
        return $this->belongsTo(SesiPresensi::class);
    }
}