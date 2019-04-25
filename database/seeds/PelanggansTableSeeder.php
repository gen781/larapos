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
                'nama'      => 'Antonius',
                'hp'        => '081375881568',
                'alamat'    => 'Jl. Marindal Gg. Syukur No.34 - Marindal Satu'
            ]
        ]);
    }
}
