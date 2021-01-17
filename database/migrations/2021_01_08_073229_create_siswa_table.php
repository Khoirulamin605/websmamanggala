<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('no_induk', 20);
            $table->string('nama_siswa', 50);
            $table->string('tempat_lahir', 20);
            $table->string('tanggal_lahir', 20);
            $table->string('jenis_kelamin', 20);
            $table->string('alamat', 100)->nullable();
            $table->string('wali', 50);
            $table->string('avatar', 30)->nullable();
            $table->string('kelas', 10)->nullable();
            $table->integer('jurusan')->nullable();
            $table->string('tanggal_masuk', 20)->nullable();
            $table->string('alasan_masuk', 20)->nullable();
            $table->string('tanggal_keluar', 20)->nullable();
            $table->string('status_lulus', 20)->nullable();
            $table->string('status_aktif', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
