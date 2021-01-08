<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanTableSeeder extends Seeder
{
    public function run()
    {


        DB::table('jurusan')->delete();

        DB::table('jurusan')->insert(array (
            0 =>
            array (
                'id' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kepala_jurusan' => 16,
                'status' => 'Active',
            ),
            1 =>
            array (
                'id' => 3,
                'jurusan' => 'Ilmu Pengetahuan Alam',
                'kepala_jurusan' => 13,
                'status' => 'Active',
            ),
        ));


    }
}
