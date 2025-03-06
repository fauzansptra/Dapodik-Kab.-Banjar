<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_sekolah')->index();
            $table->string('npsn')->unique();
            $table->string('bentuk_pendidikan');
            $table->string('status'); // Negeri/Swasta
            $table->timestamp('last_sync')->useCurrent();
            $table->integer('jml_sync')->default(0);
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sekolah');
    }
};
