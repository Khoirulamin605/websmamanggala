<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelTableSeeder extends Seeder
{
    public function run()
    {


        DB::table('mapel')->delete();

        DB::table('mapel')->insert(array (
            0 =>
            array (
                'guru_pengajar' => 'Munik Erviyati',
                'hari' => '4',
                'id' => 2,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Bahasa Inggris',
                'status' => 'Active',
            ),
            1 =>
            array (
                'guru_pengajar' => 'Achmad Purwadi',
                'hari' => '2',
                'id' => 3,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Bahasa Arab',
                'status' => 'Active',
            ),
            2 =>
            array (
                'guru_pengajar' => 'Habibatus Sadiyah',
                'hari' => '1',
                'id' => 4,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Bahasa Indonesia',
                'status' => 'Active',
            ),
            3 =>
            array (
                'guru_pengajar' => 'Siti Nur Aeni',
                'hari' => '6',
                'id' => 5,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Matematika',
                'status' => 'Active',
            ),
            4 =>
            array (
                'guru_pengajar' => 'Achmad Machrus Romli',
                'hari' => '7',
                'id' => 6,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Ekonomi',
                'status' => 'Active',
            ),
            5 =>
            array (
                'guru_pengajar' => 'Mufathiroh',
                'hari' => '1',
                'id' => 7,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Kimia',
                'status' => 'Active',
            ),
            6 =>
            array (
                'guru_pengajar' => 'Mohamad Desi Qomaruddin',
                'hari' => '1',
                'id' => 8,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'PJOK',
                'status' => 'Active',
            ),
            7 =>
            array (
                'guru_pengajar' => 'M Saddam Yusuf',
                'hari' => '7',
                'id' => 9,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Bahasa Jawa',
                'status' => 'Active',
            ),
            8 =>
            array (
                'guru_pengajar' => 'Misbahul Munir',
                'hari' => '2',
                'id' => 10,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Pendidikan Pancasila Dan Kewarga negaraan',
                'status' => 'Active',
            ),
            9 =>
            array (
                'guru_pengajar' => 'Muhammad Salim Quthbi',
                'hari' => '6',
                'id' => 11,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Sosiologi',
                'status' => 'Active',
            ),
            10 =>
            array (
                'guru_pengajar' => 'Khoirotun Nisa',
                'hari' => '3',
                'id' => 12,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Sejarah',
                'status' => 'Active',
            ),
            11 =>
            array (
                'guru_pengajar' => 'S.nurul Laili',
                'hari' => '4',
                'id' => 13,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Pendidikan Agama Islam',
                'status' => 'Active',
            ),
            12 =>
            array (
                'guru_pengajar' => 'Munik Erviyati',
                'hari' => '3',
                'id' => 14,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'Bahasa Inggris',
                'status' => 'Active',
            ),
            13 =>
            array (
                'guru_pengajar' => 'Habibatus Sadiyah',
                'hari' => '4',
                'id' => 15,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'Bahasa Indonesia',
                'status' => 'Active',
            ),
            14 =>
            array (
                'guru_pengajar' => 'Siti Nur Aeni',
                'hari' => '4',
                'id' => 16,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'Matematika',
                'status' => 'Active',
            ),
            15 =>
            array (
                'guru_pengajar' => 'Mafrudlotun Inwaroh',
                'hari' => '3',
                'id' => 17,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'Ekonomi',
                'status' => 'Active',
            ),
            16 =>
            array (
                'guru_pengajar' => 'Mohamad Desi Qomaruddin',
                'hari' => '2',
                'id' => 19,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'PJOK',
                'status' => 'Active',
            ),
            17 =>
            array (
                'guru_pengajar' => 'M Saddam Yusuf',
                'hari' => '6',
                'id' => 20,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'Bahasa Jawa',
                'status' => 'Active',
            ),
            18 =>
            array (
                'guru_pengajar' => 'Pranoto Jatmiko',
                'hari' => '2',
                'id' => 21,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'SBK',
                'status' => 'Active',
            ),
            19 =>
            array (
                'guru_pengajar' => 'Achmad Purwadi',
                'hari' => '7',
                'id' => 22,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'PAI',
                'status' => 'Active',
            ),
            20 =>
            array (
                'guru_pengajar' => 'Khoirotun Nisa',
                'hari' => '7',
                'id' => 23,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'Sejarah',
                'status' => 'Active',
            ),
            21 =>
            array (
                'guru_pengajar' => 'Achmad Machrus Romli',
                'hari' => '1',
                'id' => 24,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'Sosiologi',
                'status' => 'Active',
            ),
            22 =>
            array (
                'guru_pengajar' => 'Adib Maimun',
                'hari' => '6',
                'id' => 25,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'TIK',
                'status' => 'Active',
            ),
            23 =>
            array (
                'guru_pengajar' => 'Misbahul Munir',
                'hari' => '2',
                'id' => 26,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XI',
                'nama_mapel' => 'Pendidikan Pancasila Dan Kewarga negaraan',
                'status' => 'Active',
            ),
            24 =>
            array (
                'guru_pengajar' => 'Munik Erviyati',
                'hari' => '4',
                'id' => 27,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'Bahasa Inggris',
                'status' => 'Active',
            ),
            25 =>
            array (
                'guru_pengajar' => 'Habibatus Sadiyah',
                'hari' => '2',
                'id' => 28,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'Bahasa Indonesia',
                'status' => 'Active',
            ),
            26 =>
            array (
                'guru_pengajar' => 'Siti Nur Aeni',
                'hari' => '3',
                'id' => 29,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'Matematika',
                'status' => 'Active',
            ),
            27 =>
            array (
                'guru_pengajar' => 'Muhammad Salim Quthbi',
                'hari' => '2',
                'id' => 30,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'Ekonomi',
                'status' => 'Active',
            ),
            28 =>
            array (
                'guru_pengajar' => 'Khoirotun Nisa',
                'hari' => '1',
                'id' => 31,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'Sejarah',
                'status' => 'Active',
            ),
            29 =>
            array (
                'guru_pengajar' => 'Adib Maimun',
                'hari' => '7',
                'id' => 32,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'TIK',
                'status' => 'Active',
            ),
            30 =>
            array (
                'guru_pengajar' => 'Mohamad Desi Qomaruddin',
                'hari' => '1',
                'id' => 33,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'PJOK',
                'status' => 'Active',
            ),
            31 =>
            array (
                'guru_pengajar' => 'Misbahul Munir',
                'hari' => '6',
                'id' => 34,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'Pendidikan Pancasila Dan Kewarga negaraan',
                'status' => 'Active',
            ),
            32 =>
            array (
                'guru_pengajar' => 'Achmad Purwadi',
                'hari' => '7',
                'id' => 35,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'PAI',
                'status' => 'Active',
            ),
            33 =>
            array (
                'guru_pengajar' => 'M Saddam Yusuf',
                'hari' => '6',
                'id' => 36,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'Bahasa Jawa',
                'status' => 'Active',
            ),
            34 =>
            array (
                'guru_pengajar' => 'Achmad Machrus Romli',
                'hari' => '4',
                'id' => 37,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'Sosiologi',
                'status' => 'Active',
            ),
            35 =>
            array (
                'guru_pengajar' => 'Pranoto Jatmiko',
                'hari' => '6',
                'id' => 38,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas XII',
                'nama_mapel' => 'SBK',
                'status' => 'Active',
            ),
            36 =>
            array (
                'guru_pengajar' => 'Adib Maimun',
                'hari' => '3',
                'id' => 39,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'TIK',
                'status' => 'Active',
            ),
            37 =>
            array (
                'guru_pengajar' => 'Achmad Purwadi',
                'hari' => '6',
                'id' => 40,
                'jumlah_jam' => 2,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Bahasa Arab',
                'status' => 'Active',
            ),
            38 =>
            array (
                'guru_pengajar' => 'Mafrudlotun Inwaroh',
                'hari' => '1',
                'id' => 41,
                'jumlah_jam' => 3,
                'jurusan' => 'Ilmu Pengetahuan Sosial',
                'kelas' => 'Kelas X',
                'nama_mapel' => 'Geografi',
                'status' => 'Active',
            ),
        ));


    }
}
