<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'id_bahan';
    public $timestamps = true;

    protected $fillable = [
        'nama_bahan',
        'satuan',
        'stok_saat_ini',
        'stok_minimum',
        'harga_per_satuan',
    ];
}
