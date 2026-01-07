<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    use HasFactory;

    protected $table = 'stok_opname';

    protected $primaryKey = 'id_opname';
    protected $fillable = [
        'id_opname',
        'tanggal_update',
        'id_barang',
        'jumlah_fisik',
        'keterangan'
    ];
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_barang');
    }


    public $timestamps = false;

    
}
