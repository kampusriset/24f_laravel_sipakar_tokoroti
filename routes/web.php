<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produk', [ProdukController::class, 'index']);

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/export/transaksi/excel', [ExportController::class, 'excel'])
    ->name('export.transaksi.excel');
Route::get('/export/transaksi/pdf', [ExportController::class, 'pdf'])
    ->name('export.transaksi.pdf');
Route::get('/export/stok/excel', [ExportController::class, 'stokExcel'])
    ->name('export.stok.excel');
Route::get('/export/stok/pdf', [ExportController::class, 'stokPdf'])
    ->name('export.stok.pdf');

require __DIR__.'/auth.php';