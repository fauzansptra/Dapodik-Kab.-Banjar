<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sekolah_tahun', function (Blueprint $table) {
            $table->id('SekolahTahunID');
            $table->foreignId('SekolahID')->constrained('sekolah', 'SekolahID')->onDelete('cascade');
            $table->foreignId('TahunID')->constrained('tahuns', 'TahunID')->onDelete('cascade'); // Updated
            $table->integer('JumlahPesertaDidik')->default(0);
            $table->integer('JumlahGuru')->default(0);
            $table->integer('JumlahPegawai')->default(0);
            $table->integer('JumlahRombel')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sekolah_tahun');
    }
};
