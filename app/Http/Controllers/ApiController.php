<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Matkul;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function mahasiswa()
    {
        return response()->json(
            Mahasiswa::all()
        );
    }

    public function dosen()
    {
        return response()->json(
            Dosen::all()
        );
    }

    public function matkul()
    {
        return response()->json(
            Matkul::all()
        );
    }


}