<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sekolah_tahun', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('sekolah_id')->constrained('sekolah')->onDelete('cascade');
            $table->foreignId('tahun_id')->constrained('tahun')->onDelete('cascade');
            $table->integer('jml_peserta_didik')->default(0);
            $table->integer('jml_guru')->default(0);
            $table->integer('jml_pegawai')->default(0);
            $table->integer('jml_rombel')->default(0);
            $table->integer('jml_kelas')->default(0); // Added
            $table->integer('jml_lab')->default(0);   // Added
            $table->integer('jml_perpustakaan')->default(0); // Added
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sekolah_tahun');
    }
};
