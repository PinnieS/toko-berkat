<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar_detail';

    protected $primaryKey = 'id_barang_keluar_detail';

    protected $fillable = [
        'no_transaksi',
        'id_barang',
        'harga_modal',
        'harga_jual',
        'jumlah',
        'subtotal',
        'id_barang_masuk'
    ];
}
