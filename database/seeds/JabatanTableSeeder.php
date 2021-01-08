<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('jabatan')->delete();

        DB::table('jabatan')->insert(array (
            0 =>
            array (
                'gaji' => 20000,
                'id' => 1,
                'jabatan' => 'Guru',
                'keterangan' => 'Per Jam',
            ),
            1 =>
            array (
                'gaji' => 300000,
                'id' => 2,
                'jabatan' => 'Kepala Jurusan',
                'keterangan' => 'Per Bulan',
            ),
            2 =>
            array (
                'gaji' => 500000,
                'id' => 3,
                'jabatan' => 'Kepala Sekolah',
                'keterangan' => 'Per Bulan',
            ),
            3 =>
            array (
                'gaji' => 150000,
                'id' => 4,
                'jabatan' => 'Waka Kurikulum',
                'keterangan' => 'Per Bulan',
            ),
            4 =>
            array (
                'gaji' => 150000,
                'id' => 5,
                'jabatan' => 'Waka Kesiswaan',
                'keterangan' => 'Per Bulan',
            ),
            5 =>
            array (
                'gaji' => 500000,
                'id' => 6,
                'jabatan' => 'Operator',
                'keterangan' => 'Per Bulan',
            ),
            6 =>
            array (
                'gaji' => 500000,
                'id' => 7,
                'jabatan' => 'Staff TU',
                'keterangan' => 'Per Bulan',
            ),
            7 =>
            array (
                'gaji' => 100000,
                'id' => 9,
                'jabatan' => 'Wali Kelas',
                'keterangan' => 'Per Bulan',
            ),
        ));


    }
}
