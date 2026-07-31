<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StokProduk;
use Illuminate\Http\Request;

class StokProdukController extends Controller
{
    public function index()
    {
        $stokProduks = StokProduk::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $stokProduks
        ]);
    }

    public function store(Request $request)
    {
        $stokProduk = StokProduk::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $stokProduk
        ], 201);
    }

    public function show($id)
    {
        $stokProduk = StokProduk::find($id);
        if (!$stokProduk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $stokProduk
        ]);
    }

    public function update(Request $request, $id)
    {
        $stokProduk = StokProduk::find($id);
        if (!$stokProduk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $stokProduk->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $stokProduk
        ]);
    }

    public function destroy($id)
    {
        $stokProduk = StokProduk::find($id);
        if (!$stokProduk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $stokProduk->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
            'data' => null
        ]);
    }
}
