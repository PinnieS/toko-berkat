<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $primaryKey = 'id_barang_masuk';

    protected $fillable = [
        'no_transaksi',
        'nama_pemasok',
        'total_item',
        'total_harga',
        'created_at'
    ];
}
