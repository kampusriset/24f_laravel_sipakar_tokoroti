<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\StokProduk;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    public function index()
    {
        $details = DetailTransaksi::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $details
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:toko_roti.Transaksi,id_transaksi',
            'id_produk' => 'required|exists:toko_roti.Produk,id_produk',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric',
            'subtotal' => 'required|numeric',
        ]);

        $stok = StokProduk::where('id_produk', $request->id_produk)->first();

        if (!$stok || $request->jumlah > $stok->jumlah_stok) {
            return response()->json([
                'status' => 'error',
                'message' => 'Stok tidak mencukupi',
                'data' => null
            ], 422);
        }

        $detail = DetailTransaksi::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $detail
        ], 201);
    }

    public function show($id)
    {
        $detail = DetailTransaksi::find($id);

        if (!$detail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $detail
        ]);
    }

    public function update(Request $request, $id)
    {
        $detail = DetailTransaksi::find($id);

        if (!$detail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        if ($request->has('jumlah')) {
            $stok = StokProduk::where('id_produk', $detail->id_produk)->first();

            if (!$stok || $request->jumlah > $stok->jumlah_stok) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Stok tidak mencukupi',
                    'data' => null
                ], 422);
            }
        }

        $detail->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $detail
        ]);
    }

    public function destroy($id)
    {
        $detail = DetailTransaksi::find($id);

        if (!$detail) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }

        $detail->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
            'data' => null
        ]);
    }
}