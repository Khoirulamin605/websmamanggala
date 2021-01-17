<?php

use Illuminate\Database\Seeder;

use Database\Seeders\AbsenTableSeeder;
use Database\Seeders\JabatanTableSeeder;
use Database\Seeders\JadwalTableSeeder;
use Database\Seeders\JurusanTableSeeder;
use Database\Seeders\KelasTableSeeder;
use Database\Seeders\KeuanganTableSeeder;
use Database\Seeders\MapelTableSeeder;
use Database\Seeders\NilaiTableSeeder;
use Database\Seeders\PegawaiTableSeeder;
use Database\Seeders\PenggajianTableSeeder;
use Database\Seeders\SekolahTableSeeder;
use Database\Seeders\SiswaTableSeeder;
use Database\Seeders\SppTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(AbsenTableSeeder::class);
        $this->call(JabatanTableSeeder::class);
        $this->call(JadwalTableSeeder::class);
        $this->call(JurusanTableSeeder::class);
        $this->call(KelasTableSeeder::class);
        $this->call(KeuanganTableSeeder::class);
        $this->call(MapelTableSeeder::class);
        $this->call(NilaiTableSeeder::class);
        $this->call(PegawaiTableSeeder::class);
        $this->call(PenggajianTableSeeder::class);
        $this->call(SekolahTableSeeder::class);
        $this->call(SiswaTableSeeder::class);
        $this->call(SppTableSeeder::class);
    }
}
