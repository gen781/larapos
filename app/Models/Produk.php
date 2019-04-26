<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'kode_produk', 'nama', 'satuan', 'harga_beli', 'harga_jual', 'stok'
    ];

    public function satuan(){
        return $this->hasOne(Satuan::class,'id','satuan');
    }
}
