<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';

    protected $primaryKey = 'id_barang_keluar';

    protected $fillable = [
        'no_transaksi',
        'nama_pelanggan',
        'telepon',
        'total_item',
        'total_harga',
        'diskon',
        'bayar',
        'kembali',
        'metode_pembayaran',
        'id_user',
        'created_at'
    ];
}
