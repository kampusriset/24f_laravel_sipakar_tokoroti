<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokProduk extends Model
{
    protected $table = 'stok_produk';
    protected $primaryKey = 'id_stok_produk';
    public $timestamps = false;

    protected $fillable = [
        'id_produk',
        'jumlah_stok',
        'tanggal_update',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
