<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sesi_presensi_id')
                ->unique()
                ->constrained('sesi_presensi')
                ->cascadeOnDelete();

            $table->string('kode')->unique();

            $table->dateTime('berlaku_mulai');

            $table->dateTime('berlaku_sampai');

            $table->string('status')->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_codes');
    }
};