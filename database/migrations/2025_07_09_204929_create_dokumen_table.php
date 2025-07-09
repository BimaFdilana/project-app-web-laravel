<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_kriteria_id')->constrained('sub_kriteria');
            $table->foreignId('user_id')->comment('User yang mengunggah')->constrained('users');
            $table->string('nama_file_original');
            $table->string('path_file');
            $table->enum('status', [
                'diunggah',
                'perlu_revisi_kaprodi',
                'disetujui_kaprodi',
                'perlu_revisi_asesor',
                'selesai'
            ])->default('diunggah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumen');
    }
};