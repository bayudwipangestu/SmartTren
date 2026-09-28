<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sesi_presensi_id')
                ->constrained('sesi_presensi')
                ->cascadeOnDelete();

            $table->foreignId('mahasantri_id')
                ->constrained('mahasantri')
                ->cascadeOnDelete();

            $table->timestamp('waktu_presensi');

            $table->string('metode');

            $table->string('status');

            $table->text('keterangan')->nullable();

            $table->timestamps();

            $table->unique([
                'sesi_presensi_id',
                'mahasantri_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};