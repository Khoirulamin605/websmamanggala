<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeuanganTableSeeder extends Seeder
{
    public function run()
    {


        DB::table('keuangan')->delete();

        DB::table('keuangan')->insert(array (
            0 =>
            array (
                'id' => 2,
                'keterangan' => 'Sisa Pembelian Barang',
                'saldo_akhir' => 10000,
                'tanggal' => '2020-06-25',
                'uang_keluar' => 0,
                'uang_masuk' => 10000,
            ),
            1 =>
            array (
                'id' => 3,
                'keterangan' => 'MAsuk dari dana BOS Triwulan III',
                'saldo_akhir' => 21010000,
                'tanggal' => '2020-06-25',
                'uang_keluar' => 0,
                'uang_masuk' => 21000000,
            ),
            2 =>
            array (
                'id' => 4,
                'keterangan' => 'Pembelian Kertas A4',
                'saldo_akhir' => 20910000,
                'tanggal' => '2020-06-25',
                'uang_keluar' => 100000,
                'uang_masuk' => 0,
            ),
        ));


    }
}
