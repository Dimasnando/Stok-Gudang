<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class BajuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('baju')->insert([
            [
                'Merk'         => 'Erigo',
                'Ukuran'       => 'M',
                'Jumlah'       => 46,
                'pendiri_id'   => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'Merk'         => 'Celcius',
                'Ukuran'       => 'S',
                'Jumlah'       => 32,
                'pendiri_id'   => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'Merk'         => 'Maternal',
                'Ukuran'       => 'XL',
                'Jumlah'       => 10,
                'pendiri_id'   => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],

        ]);
    }
}
