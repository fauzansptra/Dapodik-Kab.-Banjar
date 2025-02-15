<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_kecamatan')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kecamatan');
    }
};
