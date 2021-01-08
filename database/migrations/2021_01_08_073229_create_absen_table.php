<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_pegawai');
            $table->string('tanggal', 20);
            $table->string('masuk', 20);
            $table->string('pulang', 20);
            $table->integer('jumlah_jam');
            $table->string('keterangan', 50);
            $table->string('bulan_tahun', 20)->nullable();
            $table->string('id_qr', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen');
    }
}
