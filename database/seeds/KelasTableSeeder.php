<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasTableSeeder extends Seeder
{
    public function run()
    {


        DB::table('kelas')->delete();

        DB::table('kelas')->insert(array (
            0 =>
            array (
                'id' => 1,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'nama_kelas' => 'Kelas X',
                'rombel' => 'Kelas X',
                'status' => 'Active',
                'wali_kelas' => 'Mohamad Desi Qomaruddin',
            ),
            1 =>
            array (
                'id' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'nama_kelas' => 'Keals XI',
                'rombel' => 'Kelas XI',
                'status' => 'Active',
                'wali_kelas' => 'Achmad Purwadi',
            ),
            2 =>
            array (
                'id' => 4,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'nama_kelas' => 'Keals XII',
                'rombel' => 'Kelas XII',
                'status' => 'Active',
                'wali_kelas' => 'Mafrudlotun Inwaroh',
            ),
        ));


    }
}
