<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapel', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama_mapel', 50);
            $table->string('jurusan', 100);
            $table->string('kelas', 10);
            $table->string('guru_pengajar', 100);
            $table->string('hari', 20);
            $table->integer('jumlah_jam');
            $table->string('status', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapel');
    }
}
