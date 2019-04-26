<?php

use Illuminate\Database\Seeder;
use App\Models\Satuan;

class SatuansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Satuan::insert([
            [
                'nama_satuan'  => 'Kotak'
            ],
            [
                'nama_satuan'  => 'Bungkus'
            ],
            [
                'nama_satuan'  => 'Pcs'
            ]
        ]);
    }
}
