<?php

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::insert([
            [
                'nama'      => 'Logikreasi',
                'telepon'   => '0616438876',
                'alamat'    => 'Jl. Puttri Hijau - Medan'
            ]
        ]);
    }
}
