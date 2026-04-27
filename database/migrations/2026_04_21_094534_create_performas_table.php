<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemain_id')->constrained('pemains')->onDelete('cascade');
            $table->foreignId('latihan_id')->constrained('latihans')->onDelete('cascade');
            $table->foreignId('pelatih_id')->nullable()->constrained('pelatihs')->onDelete('set null');
            $table->integer('stamina')->nullable();
            $table->integer('speed')->nullable();
            $table->integer('shooting')->nullable();
            $table->integer('passing')->nullable();
            $table->integer('dribbling')->nullable();
            $table->integer('defense')->nullable();
            $table->text('catatan')->nullable();
            $table->date('tanggal_penilaian')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performas');
    }
};