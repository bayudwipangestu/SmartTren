<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function mahasantri()
    {
        return $this->hasOne(Mahasantri::class);
    }

    public function pengurus()
    {
        return $this->hasOne(Pengurus::class);
    }

    public function masterAdmin()
    {
        return $this->hasOne(MasterAdmin::class);
    }

    public function laporanPresensi()
    {
        return $this->hasMany(LaporanPresensi::class, 'dibuat_oleh');
    }
}