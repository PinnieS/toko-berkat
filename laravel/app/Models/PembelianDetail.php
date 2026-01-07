<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_detail';

    protected $primaryKey = 'id_barang_masuk_detail';

    protected $fillable = [
        'no_transaksi',
        'id_barang',
        'harga_beli',
        'harga_jual',
        'jumlah',
        'sisa',
        'subtotal',
    
    ];
}
