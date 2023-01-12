<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PendiriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pendiri')->insert([
            [
                'Nama'         => 'Dimas',
                'Jenkel'       => "Laki - Laki",
                'created_at'   => date("Y-m-d H:i:s")
            ],
            [
                'Nama'         => 'Clara',
                'Jenkel'       => "Perempuan",
                'created_at'   => date("Y-m-d H:i:s")
            ],
            [
                'Nama'         => 'Peri Sandiko',
                'Jenkel'       => "Laki - Laki",
                'created_at'   => date("Y-m-d H:i:s")
            ],
        ]);
    }
}
