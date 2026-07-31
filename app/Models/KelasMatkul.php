<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasMatkul extends Model
{
    protected $table = 'kelas_matkul';

    protected $fillable = [
        'dosen_id',
        'matkul_id',
        'kelas',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }
}