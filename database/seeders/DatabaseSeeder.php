<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. USERS
        |--------------------------------------------------------------------------
        */

        $mahasantriUsers = [];

        for ($i = 1; $i <= 10; $i++) {
            $mahasantriUsers[] = DB::table('users')->insertGetId([
                'name' => 'Mahasantri ' . $i,
                'email' => 'mahasantri' . $i . '@smarttren.test',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'mahasantri',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $pengurusUsers = [];

        for ($i = 1; $i <= 2; $i++) {
            $pengurusUsers[] = DB::table('users')->insertGetId([
                'name' => 'Pengurus ' . $i,
                'email' => 'pengurus' . $i . '@smarttren.test',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'pengurus',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $masterAdminUser = DB::table('users')->insertGetId([
            'name' => 'Master Admin',
            'email' => 'admin@smarttren.test',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'master_admin',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. MAHASANTRI
        |--------------------------------------------------------------------------
        */

        $mahasantriIds = [];

        for ($i = 0; $i < 10; $i++) {
            $mahasantriIds[] = DB::table('mahasantri')->insertGetId([
                'user_id' => $mahasantriUsers[$i],
                'nim' => 'MT' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'jurusan' => 'Teknik Informatika',
                'semester' => (($i % 8) + 1),
                'kamar' => 'Kamar ' . (($i % 5) + 1),
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. PENGURUS
        |--------------------------------------------------------------------------
        */

        DB::table('pengurus')->insert([
            [
                'user_id' => $pengurusUsers[0],
                'jabatan' => 'Koordinator SmartTren',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $pengurusUsers[1],
                'jabatan' => 'Pengurus Presensi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4. MASTER ADMIN
        |--------------------------------------------------------------------------
        */

        DB::table('master_admin')->insert([
            'user_id' => $masterAdminUser,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | 5. KEGIATAN
        |--------------------------------------------------------------------------
        */

        $kegiatanIds = [];

        $kegiatanData = [
            [
                'nama_kegiatan' => 'Shalat Subuh Berjamaah',
                'deskripsi' => 'Kegiatan shalat Subuh berjamaah.',
                'tanggal' => '2026-09-28',
                'waktu_mulai' => '04:00:00',
                'waktu_selesai' => '05:00:00',
                'status' => 'aktif',
            ],
            [
                'nama_kegiatan' => 'Kajian Pagi',
                'deskripsi' => 'Kajian keislaman untuk mahasantri.',
                'tanggal' => '2026-09-28',
                'waktu_mulai' => '06:00:00',
                'waktu_selesai' => '07:00:00',
                'status' => 'aktif',
            ],
            [
                'nama_kegiatan' => 'Diniyah Malam',
                'deskripsi' => 'Pembelajaran diniyah malam.',
                'tanggal' => '2026-09-28',
                'waktu_mulai' => '19:00:00',
                'waktu_selesai' => '20:30:00',
                'status' => 'aktif',
            ],
            [
                'nama_kegiatan' => 'Pengajian Rutin',
                'deskripsi' => 'Pengajian rutin SmartTren.',
                'tanggal' => '2026-09-29',
                'waktu_mulai' => '19:00:00',
                'waktu_selesai' => '20:30:00',
                'status' => 'aktif',
            ],
        ];

        foreach ($kegiatanData as $data) {
            $kegiatanIds[] = DB::table('kegiatan')->insertGetId([
                'nama_kegiatan' => $data['nama_kegiatan'],
                'deskripsi' => $data['deskripsi'],
                'tanggal' => $data['tanggal'],
                'waktu_mulai' => $data['waktu_mulai'],
                'waktu_selesai' => $data['waktu_selesai'],
                'status' => $data['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 6. SESI PRESENSI
        |--------------------------------------------------------------------------
        */

        $sesiIds = [];

        foreach ($kegiatanIds as $kegiatanId) {

            $tanggalKegiatan = DB::table('kegiatan')
                ->where('id', $kegiatanId)
                ->value('tanggal');

            for ($sesi = 1; $sesi <= 2; $sesi++) {

                if ($sesi === 1) {
                    $waktuMulai = $tanggalKegiatan . ' 00:00:00';
                    $waktuSelesai = $tanggalKegiatan . ' 11:59:59';
                } else {
                    $waktuMulai = $tanggalKegiatan . ' 12:00:00';
                    $waktuSelesai = $tanggalKegiatan . ' 23:59:59';
                }

                $dataSesi = [
                    'kegiatan_id' => $kegiatanId,
                    'nama_sesi' => 'Sesi ' . $sesi,
                    'status' => 'aktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if (Schema::hasColumn('sesi_presensi', 'waktu_mulai')) {
                    $dataSesi['waktu_mulai'] = $waktuMulai;
                }

                if (Schema::hasColumn('sesi_presensi', 'waktu_selesai')) {
                    $dataSesi['waktu_selesai'] = $waktuSelesai;
                }

                if (
                    !Schema::hasColumn('sesi_presensi', 'waktu_mulai') &&
                    Schema::hasColumn('sesi_presensi', 'mulai')
                ) {
                    $dataSesi['mulai'] = $waktuMulai;
                }

                if (
                    !Schema::hasColumn('sesi_presensi', 'waktu_selesai') &&
                    Schema::hasColumn('sesi_presensi', 'selesai')
                ) {
                    $dataSesi['selesai'] = $waktuSelesai;
                }

                $sesiIds[] = DB::table('sesi_presensi')
                    ->insertGetId($dataSesi);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 7. QR CODES
        |--------------------------------------------------------------------------
        */

        foreach ($sesiIds as $index => $sesiId) {
            DB::table('qr_codes')->insert([
                'sesi_presensi_id' => $sesiId,
                'kode' => 'SMARTTREN-QR-' .
                    str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'berlaku_mulai' => now(),
                'berlaku_sampai' => now()->addHours(2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 8. PRESENSI
        |--------------------------------------------------------------------------
        */

        $presensiData = [];

        for ($i = 0; $i < 30; $i++) {

            $sesiId = $sesiIds[$i % count($sesiIds)];

            $mahasantriId = $mahasantriIds[
                $i % count($mahasantriIds)
            ];

            $presensiData[] = [
                'sesi_presensi_id' => $sesiId,
                'mahasantri_id' => $mahasantriId,
                'waktu_presensi' => now()->subDays($i % 4),
                'metode' => ($i % 2 === 0) ? 'qr' : 'manual',
                'status' => 'hadir',
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('presensi')->insert($presensiData);

        /*
        |--------------------------------------------------------------------------
        | 9. LAPORAN PRESENSI
        |--------------------------------------------------------------------------
        */

        for ($i = 0; $i < 3; $i++) {

            DB::table('laporan_presensi')->insert([
                'kegiatan_id' => $kegiatanIds[$i],
                'dibuat_oleh' => $pengurusUsers[$i % 2],
                'tanggal_laporan' => now()
                    ->subDays($i)
                    ->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}