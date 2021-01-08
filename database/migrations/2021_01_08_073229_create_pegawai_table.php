<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('kode_pegawai', 20);
            $table->string('nama_pegawai', 50);
            $table->string('tempat_lahir', 50);
            $table->string('tanggal_lahir', 20);
            $table->string('jenis_kelamin', 20);
            $table->string('alamat', 100);
            $table->string('pendidikan_terahir', 50);
            $table->string('email', 50)->nullable();
            $table->string('password', 100)->nullable();
            $table->string('role', 10)->nullable();
            $table->string('pegawai', 10);
            $table->string('tugas_tambahan', 100)->nullable();
            $table->string('avatar', 50)->nullable();
            $table->string('status', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
