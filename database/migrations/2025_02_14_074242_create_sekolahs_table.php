<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id('SekolahID');
            $table->string('NamaSekolah')->index();
            $table->string('NPSN')->unique();
            $table->string('BentukPendidikan');
            $table->string('Status'); // Negeri/Swasta
            $table->timestamp('LastSync')->useCurrent();
            $table->integer('JmlSync')->default(0);
            $table->foreignId('KecamatanID')->constrained('kecamatan', 'KecamatanID')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sekolah');
    }
};
