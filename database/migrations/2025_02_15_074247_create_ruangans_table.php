<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id('RuanganID');
            $table->foreignId('SekolahID')->constrained('sekolahs', 'SekolahID')->onDelete('cascade');
            $table->enum('Jenis', ['Kelas', 'Lab', 'Perpustakaan']);
            $table->integer('Jumlah')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ruangans');
    }
};
