<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ruangan_tahun', function (Blueprint $table) {
            $table->id('RuanganTahunID');
            $table->foreignId('SekolahTahunID')->constrained('sekolah_tahun', 'SekolahTahunID')->onDelete('cascade');
            $table->enum('JenisRuangan', ['Kelas', 'Lab', 'Perpustakaan']);
            $table->integer('Jumlah')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ruangan_tahun');
    }
};
