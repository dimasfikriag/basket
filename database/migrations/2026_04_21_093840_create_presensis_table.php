<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('latihan_id')->constrained('latihans')->onDelete('cascade');
            $table->foreignId('pemain_id')->constrained('pemains')->onDelete('cascade');
            $table->enum('status_kehadiran', ['hadir', 'izin', 'sakit', 'alpha']);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};