<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggajianTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('penggajian')->delete();

        DB::table('penggajian')->insert(array (
            0 =>
            array (
                'gaji' => 60000,
                'id' => 1,
                'id_pegawai' => 3,
                'periode' => '10-2020',
                'tambahan' => 150000,
                'total' => 210000,
                'total_jam' => 3,
            ),
            1 =>
            array (
                'gaji' => 60000,
                'id' => 2,
                'id_pegawai' => 16,
                'periode' => '10-2020',
                'tambahan' => 300000,
                'total' => 360000,
                'total_jam' => 3,
            ),
            2 =>
            array (
                'gaji' => 100000,
                'id' => 3,
                'id_pegawai' => 2,
                'periode' => '10-2020',
                'tambahan' => 150000,
                'total' => 250000,
                'total_jam' => 5,
            ),
            3 =>
            array (
                'gaji' => 40000,
                'id' => 4,
                'id_pegawai' => 14,
                'periode' => '10-2020',
                'tambahan' => 0,
                'total' => 40000,
                'total_jam' => 2,
            ),
            4 =>
            array (
                'gaji' => 500000,
                'id' => 5,
                'id_pegawai' => 1,
                'periode' => '10-2020',
                'tambahan' => 0,
                'total' => 500000,
                'total_jam' => 0,
            ),
            5 =>
            array (
                'gaji' => 60000,
                'id' => 6,
                'id_pegawai' => 6,
                'periode' => '10-2020',
                'tambahan' => 0,
                'total' => 60000,
                'total_jam' => 3,
            ),
            6 =>
            array (
                'gaji' => 500000,
                'id' => 7,
                'id_pegawai' => 22,
                'periode' => '10-2020',
                'tambahan' => 0,
                'total' => 500000,
                'total_jam' => 0,
            ),
        ));


    }
}
