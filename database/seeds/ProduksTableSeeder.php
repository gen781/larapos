<?php

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProduksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produk::insert([
            [
                'kode_produk'   => 'prd00001',
                'nama'          => 'Mouse Logitech B100',
                'kemasan'       => 1,
                'harga_beli'    => 80000,
                'harga_jual'    => 100000,
                'stok'          => 12
            ]
        ]);
    }
}
