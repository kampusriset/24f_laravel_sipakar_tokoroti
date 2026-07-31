<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        dd([
            'search_path' => DB::select("SHOW search_path"),
            'current_schema' => DB::select("SELECT current_schema()"),
            'count' => DB::table('produk')->count(),
        ]);
    }
}