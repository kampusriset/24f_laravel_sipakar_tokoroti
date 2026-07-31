<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $produks
        ]);
    }

    public function store(Request $request)
    {
        $produk = Produk::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $produk
        ], 201);
    }

    public function show($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $produk
        ]);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $produk->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $produk
        ]);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $produk->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
            'data' => null
        ]);
    }
}
