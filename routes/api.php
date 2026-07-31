<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KategoriProdukController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\StokProdukController;
use App\Http\Controllers\Api\BahanBakuController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\DetailTransaksiController;
use App\Http\Controllers\Api\PembayaranController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('kategori_produk', KategoriProdukController::class);
    Route::apiResource('produk', ProdukController::class);
    Route::apiResource('stok_produk', StokProdukController::class);
    Route::apiResource('bahan_baku', BahanBakuController::class);
    Route::apiResource('transaksi', TransaksiController::class);
    Route::apiResource('detail_transaksi', DetailTransaksiController::class);
    Route::apiResource('pembayaran', PembayaranController::class);
    Route::apiResource('user', UserController::class);
});
