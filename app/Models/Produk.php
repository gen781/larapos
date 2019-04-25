<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'kode_produk', 'nama', 'kemasan', 'harga_beli', 'harga_jual', 'stok'
    ];
}
