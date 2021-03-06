<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiTableSeeder extends Seeder
{
    public function run()
    {


        DB::table('pegawai')->delete();

        DB::table('pegawai')->insert(array (
            0 =>
            array (
                'alamat' => 'Tebluru-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => 'khoirulamin@gmail.com',
                'id' => 1,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130202',
                'nama_pegawai' => 'Ahmad Khoirul Amin',
                'password' => '$2y$10$tMzKuc.jMTgmKaBdqMbW5.8zspNMiIHiNoihuSsZ0SNLrRkzBuN76',
                'pegawai' => '6',
                'pendidikan_terahir' => 'D2',
                'role' => 'admin',
                'status' => 'Active',
                'tanggal_lahir' => '1998-03-01',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => NULL,
            ),
            1 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 2,
                'jenis_kelamin' => 'Perempuan',
                'kode_pegawai' => '8842757658130162',
                'nama_pegawai' => 'Munik Erviyati',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1994-06-01',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => 'Waka Kurikulum',
            ),
            2 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 3,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '8842757658130163',
                'nama_pegawai' => 'Achmad Machrus Romli',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1970-07-07',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => 'Waka Kesiswaan',
            ),
            3 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 4,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130203',
                'nama_pegawai' => 'Achmad Purwadi',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1988-06-07',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => 'Wali Kelas',
            ),
            4 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 5,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130204',
                'nama_pegawai' => 'Ahmad Kafani',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1973-12-12',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => '',
            ),
            5 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 6,
                'jenis_kelamin' => 'Perempuan',
                'kode_pegawai' => '3939766667130205',
                'nama_pegawai' => 'Habibatus Sadiyah',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1989-12-10',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => '',
            ),
            6 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 7,
                'jenis_kelamin' => 'Perempuan',
                'kode_pegawai' => '3939766667130206',
                'nama_pegawai' => 'Khoirotun Nisa',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1993-06-01',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => '',
            ),
            7 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 8,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130207',
                'nama_pegawai' => 'M Saddam Yusuf',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1991-01-25',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => '',
            ),
            8 =>
            array (
                'alamat' => 'Tebluru-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 9,
                'jenis_kelamin' => 'Perempuan',
                'kode_pegawai' => '3939766667130208',
                'nama_pegawai' => 'Mafrudlotun Inwaroh',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1987-11-04',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => 'Wali Kelas',
            ),
            9 =>
            array (
                'alamat' => 'Tebluru-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 10,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130209',
                'nama_pegawai' => 'Misbahul Munir',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => '',
                'status' => 'Active',
                'tanggal_lahir' => '1970-12-20',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => 'Kepala Sekolah',
            ),
            10 =>
            array (
                'alamat' => 'Sukodadi-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 11,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130211',
                'nama_pegawai' => 'Mohamad Desi Qomaruddin',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1987-12-08',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => 'Wali Kelas',
            ),
            11 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 12,
                'jenis_kelamin' => 'Perempuan',
                'kode_pegawai' => '3939766667130212',
                'nama_pegawai' => 'Mufathiroh',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1990-05-10',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => '',
            ),
            12 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 13,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130213',
                'nama_pegawai' => 'Muhammad Salim Quthbi',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1991-03-04',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => 'Kepala Jurusan',
            ),
            13 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 14,
                'jenis_kelamin' => 'Perempuan',
                'kode_pegawai' => '3939766667130214',
                'nama_pegawai' => 'S.nurul Laili',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1971-07-14',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => '',
            ),
            14 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 15,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130215',
                'nama_pegawai' => 'Sirojul Haq',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1989-05-25',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => '',
            ),
            15 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 16,
                'jenis_kelamin' => 'Perempuan',
                'kode_pegawai' => '3939766667130216',
                'nama_pegawai' => 'Siti Nur Aeni',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1992-04-03',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => 'Kepala Jurusan',
            ),
            16 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 17,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130217',
                'nama_pegawai' => 'Adib Maimun',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1998-07-05',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => NULL,
            ),
            17 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 18,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130218',
                'nama_pegawai' => 'Miftahul Khoir',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1980-07-02',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => NULL,
            ),
            18 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 19,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130219',
                'nama_pegawai' => 'Pranoto Jatmiko',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1985-07-02',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => NULL,
            ),
            19 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 20,
                'jenis_kelamin' => 'Laki-Laki',
                'kode_pegawai' => '3939766667130220',
                'nama_pegawai' => 'Fathul Mujib',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1987-07-15',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => NULL,
            ),
            20 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 21,
                'jenis_kelamin' => 'Perempuan',
                'kode_pegawai' => '3939766667130221',
                'nama_pegawai' => 'Miftahul Jannah',
                'password' => NULL,
                'pegawai' => '1',
                'pendidikan_terahir' => 'S1',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1995-07-24',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => NULL,
            ),
            21 =>
            array (
                'alamat' => 'Dadapan-Solokuro-Lamongan',
                'avatar' => NULL,
                'email' => NULL,
                'id' => 22,
                'jenis_kelamin' => 'Perempuan',
                'kode_pegawai' => '3939766667130222',
                'nama_pegawai' => 'Yusrotun Naimah',
                'password' => NULL,
                'pegawai' => '7',
                'pendidikan_terahir' => 'SMA',
                'role' => NULL,
                'status' => 'Active',
                'tanggal_lahir' => '1994-07-06',
                'tempat_lahir' => 'Lamongan',
                'tugas_tambahan' => NULL,
            ),
        ));


    }
}
