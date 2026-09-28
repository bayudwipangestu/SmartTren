<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasantri extends Model
{
    use HasFactory;

    protected $table = 'mahasantri';

    protected $fillable = [
        'user_id',
        'nim',
        'jurusan',
        'semester',
        'kamar',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
}