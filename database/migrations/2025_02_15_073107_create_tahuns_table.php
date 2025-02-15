<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tahuns', function (Blueprint $table) {
            $table->id('TahunID');
            $table->year('Tahun')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tahuns');
    }
};
