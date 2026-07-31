<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama_pegawai',
        'jabatan',
        'no_telepon',
        'alamat',
    ];

    public $timestamps = true;

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_pegawai', 'id_pegawai');
    }
}