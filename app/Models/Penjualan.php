<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'no_trans', 'tgl_trans', 'pelanggan', 'user', 'sub_total', 'diskon', 'total_harga'
    ];
}
