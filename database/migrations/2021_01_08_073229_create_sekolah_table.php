<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('npsn')->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('alamat', 200)->nullable();
            $table->string('tahun_berdiri', 20)->nullable();
            $table->integer('kepala')->nullable();
            $table->integer('wakakur')->nullable();
            $table->integer('wakasis')->nullable();
            $table->string('akreditasi', 10)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('telpon', 20)->nullable();
            $table->string('kurikulum', 100)->nullable();
            $table->string('status', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sekolah');
    }
}
