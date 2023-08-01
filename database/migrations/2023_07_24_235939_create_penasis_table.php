<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penasis', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('deskripsi');
            $table->string('kategori');
            $table->string('berkasPendukung')->nullable();
            $table->string('tempat')->nullable();
            $table->string('tanggapan')->nullable();
            $table->string('status');
            $table->string('pengirim');
            $table->string('anonim')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penasis');
    }
}
