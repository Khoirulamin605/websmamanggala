<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsenTableSeeder extends Seeder
{
    public function run()
    {


        DB::table('absen')->delete();

        DB::table('absen')->insert(array (
            0 =>
            array (
                'bulan_tahun' => '10-2020',
                'id' => 1,
                'id_pegawai' => 2,
                'id_qr' => '5f911cceb53d6',
                'jumlah_jam' => 2,
                'keterangan' => '',
                'masuk' => '-',
                'pulang' => '-',
                'tanggal' => '22-10-2020',
            ),
            1 =>
            array (
                'bulan_tahun' => '10-2020',
                'id' => 2,
                'id_pegawai' => 14,
                'id_qr' => '5f911cceb53d6',
                'jumlah_jam' => 2,
                'keterangan' => '',
                'masuk' => '-',
                'pulang' => '-',
                'tanggal' => '22-10-2020',
            ),
            2 =>
            array (
                'bulan_tahun' => '10-2020',
                'id' => 3,
                'id_pegawai' => 6,
                'id_qr' => '5f911cceb53d6',
                'jumlah_jam' => 3,
                'keterangan' => '',
                'masuk' => '-',
                'pulang' => '-',
                'tanggal' => '22-10-2020',
            ),
            3 =>
            array (
                'bulan_tahun' => '10-2020',
                'id' => 4,
                'id_pegawai' => 2,
                'id_qr' => '5f911cceb53d6',
                'jumlah_jam' => 3,
                'keterangan' => '',
                'masuk' => '-',
                'pulang' => '-',
                'tanggal' => '22-10-2020',
            ),
            4 =>
            array (
                'bulan_tahun' => '10-2020',
                'id' => 5,
                'id_pegawai' => 16,
                'id_qr' => '5f911cceb53d6',
                'jumlah_jam' => 3,
                'keterangan' => '',
                'masuk' => '-',
                'pulang' => '-',
                'tanggal' => '22-10-2020',
            ),
            5 =>
            array (
                'bulan_tahun' => '10-2020',
                'id' => 6,
                'id_pegawai' => 3,
                'id_qr' => '5f911cceb53d6',
                'jumlah_jam' => 3,
                'keterangan' => '',
                'masuk' => '-',
                'pulang' => '-',
                'tanggal' => '22-10-2020',
            ),
            6 =>
            array (
                'bulan_tahun' => '10-2020',
                'id' => 7,
                'id_pegawai' => 1,
                'id_qr' => '5f911cceb53d6',
                'jumlah_jam' => 0,
                'keterangan' => '',
                'masuk' => '-',
                'pulang' => '-',
                'tanggal' => '22-10-2020',
            ),
            7 =>
            array (
                'bulan_tahun' => '10-2020',
                'id' => 8,
                'id_pegawai' => 22,
                'id_qr' => '5f911cceb53d6',
                'jumlah_jam' => 0,
                'keterangan' => '',
                'masuk' => '-',
                'pulang' => '-',
                'tanggal' => '22-10-2020',
            ),
            8 =>
            array (
                'bulan_tahun' => '10-2020',
                'id' => 9,
                'id_pegawai' => 1,
                'id_qr' => '5f92c571bcaa6',
                'jumlah_jam' => 0,
                'keterangan' => '',
                'masuk' => '-',
                'pulang' => '-',
                'tanggal' => '23-10-2020',
            ),
            9 =>
            array (
                'bulan_tahun' => '10-2020',
                'id' => 10,
                'id_pegawai' => 22,
                'id_qr' => '5f92c571bcaa6',
                'jumlah_jam' => 0,
                'keterangan' => '',
                'masuk' => '-',
                'pulang' => '-',
                'tanggal' => '23-10-2020',
            ),
        ));


    }
}
