<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $transaksis
        ]);
    }

    public function store(Request $request)
    {
        $transaksi = Transaksi::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $transaksi
        ], 201);
    }

    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $transaksi
        ]);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $transaksi->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $transaksi
        ]);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $transaksi->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
            'data' => null
        ]);
    }
}
