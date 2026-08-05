
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\Auth\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Produk
|--------------------------------------------------------------------------
*/

Route::get('/produk', [ProdukController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Google Login
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Export
|--------------------------------------------------------------------------
*/

Route::get('/export/transaksi/excel', [ExportController::class, 'excel'])
    ->name('export.transaksi.excel');

Route::get('/export/transaksi/pdf', [ExportController::class, 'pdf'])
    ->name('export.transaksi.pdf');

Route::get('/export/stok/excel', [ExportController::class, 'stokExcel'])
    ->name('export.stok.excel');

Route::get('/export/stok/pdf', [ExportController::class, 'stokPdf'])
    ->name('export.stok.pdf');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

/*
|--------------------------------------------------------------------------
| Breeze Authentication
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';