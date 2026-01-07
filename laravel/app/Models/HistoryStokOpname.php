<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryStokOpname extends Model
{
    use HasFactory;

    protected $table = 'history_stok_opname';

    protected $fillable = [
    'id_barang', 'nama_barang', 'stok_sistem', 'jumlah_fisik', 'keterangan', 'user_name', 'tanggal_update'
    ];

    public $timestamps = false;

}
