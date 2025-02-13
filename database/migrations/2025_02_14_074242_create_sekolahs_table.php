<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id('SekolahID');
            $table->string('NamaSekolah')->index();
            $table->string('NPSN')->unique();
            $table->string('BentukPendidikan');
            $table->string('Status');
            $table->timestamp('LastSync')->useCurrent();
            $table->integer('JmlSync')->default(0);
            $table->foreignId('KecamatanID')->constrained('kecamatans', 'KecamatanID')->onDelete('cascade');
            $table->string('Semester');
            $table->integer('JumlahPesertaDidik')->default(0);
            $table->integer('JumlahGuru')->default(0);
            $table->integer('JumlahPegawai')->default(0);
            $table->integer('JumlahRombel')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sekolahs');
    }
};
