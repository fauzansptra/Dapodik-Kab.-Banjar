<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ruangan_tahun', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('sekolah_id')->constrained('sekolah')->onDelete('cascade');
            $table->foreignId('tahun_id')->constrained('tahun')->onDelete('cascade');
            $table->enum('jenis_ruangan', ['kelas', 'lab', 'perpustakaan']);
            $table->integer('jumlah')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ruangan_tahun');
    }
};
