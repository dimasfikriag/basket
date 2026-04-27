<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('latihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatih_id')->nullable()->constrained('pelatihs')->onDelete('set null');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('lokasi');
            $table->text('materi_latihan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('latihans');
    }
};