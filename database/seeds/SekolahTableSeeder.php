<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SekolahTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('sekolah')->delete();
        
        DB::table('sekolah')->insert(array (
            0 => 
            array (
                'akreditasi' => 'B',
                'alamat' => 'Jl. Sumur Mojo, Rt/Rw:10/02 Ds. Dadapan, Kec. Solokuro, Kab. Lamongan, POS:62265',
                'email' => 'smamanggalasakti@gmail.com',
                'id' => 1,
                'kepala' => 10,
                'kurikulum' => 'Kurikulum 2013',
                'nama' => 'SMAS MANGGALA SAKTI',
                'npsn' => 69857712,
                'status' => 'Swasta',
                'tahun_berdiri' => '2014-06-01',
                'telpon' => '085967176079',
                'wakakur' => 2,
                'wakasis' => 3,
            ),
        ));
        
        
    }
}