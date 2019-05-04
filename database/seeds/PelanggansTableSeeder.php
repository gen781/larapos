<?php

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelanggansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pelanggan::insert([
            [
                'nama'      => 'Umum',
                'hp'        => '0123456789',
                'alamat'    => 'Indonesia'
            ]
        ]);
    }
}
