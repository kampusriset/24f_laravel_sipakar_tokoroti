<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahanBakus = BahanBaku::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $bahanBakus
        ]);
    }

    public function store(Request $request)
    {
        $bahanBaku = BahanBaku::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data created successfully',
            'data' => $bahanBaku
        ], 201);
    }

    public function show($id)
    {
        $bahanBaku = BahanBaku::find($id);
        if (!$bahanBaku) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $bahanBaku
        ]);
    }

    public function update(Request $request, $id)
    {
        $bahanBaku = BahanBaku::find($id);
        if (!$bahanBaku) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $bahanBaku->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Data updated successfully',
            'data' => $bahanBaku
        ]);
    }

    public function destroy($id)
    {
        $bahanBaku = BahanBaku::find($id);
        if (!$bahanBaku) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
                'data' => null
            ], 404);
        }
        $bahanBaku->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
            'data' => null
        ]);
    }
}
