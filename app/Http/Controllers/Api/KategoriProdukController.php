<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategoriProduks = KategoriProduk::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $kategoriProduks
        ]);
    }

    public function store(Request $request)
    {
        $kategoriProduk = KategoriProduk::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $kategoriProduk
        ], 201);
    }

    public function show($id)
    {
        $kategoriProduk = KategoriProduk::find($id);
        if (!$kategoriProduk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $kategoriProduk
        ]);
    }

    public function update(Request $request, $id)
    {
        $kategoriProduk = KategoriProduk::find($id);
        if (!$kategoriProduk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $kategoriProduk->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $kategoriProduk
        ]);
    }

    public function destroy($id)
    {
        $kategoriProduk = KategoriProduk::find($id);
        if (!$kategoriProduk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $kategoriProduk->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
            'data' => null
        ]);
    }
}
