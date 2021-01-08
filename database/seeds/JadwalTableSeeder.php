<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalTableSeeder extends Seeder
{
    public function run()
    {


        DB::table('jadwal')->delete();



    }
}
