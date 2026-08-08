<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Models\DetailTransaksi;
use App\Models\KategoriProduk;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\StokProduk;
use App\Models\Transaksi;
use App\Services\FuzzyTsukamotoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    try {
        $stats = [
            'total_produk' => Produk::count(),
            'total_transaksi' => Transaksi::count(),
            'total_pendapatan' => Transaksi::sum('total_bayar'),
            'stok_menipis' => StokProduk::where('jumlah_stok', '<=', 10)->count(),
        ];

        $topProducts = DetailTransaksi::select(
                'id_produk',
                DB::raw('SUM(jumlah) as total_terjual'),
                DB::raw('SUM(subtotal) as total_omzet')
            )
            ->with('produk')
            ->groupBy('id_produk')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        $recentTransactions = Transaksi::with('pembayaran')
            ->latest('id_transaksi')
            ->limit(5)
            ->get();

        $lowStocks = StokProduk::with('produk')
            ->where('jumlah_stok', '<=', 10)
            ->orderBy('jumlah_stok')
            ->limit(5)
            ->get();

        $categories = KategoriProduk::withCount('produk')
            ->orderByDesc('produk_count')
            ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $monthlySales = collect(range(1, 12))->map(fn ($month) => (float) Transaksi::whereMonth('tanggal_transaksi', $month)->sum('total_bayar'));

        $monthlyMax = max(1, (float) $monthlySales->max());
    } catch (Throwable) {
        $stats = [
            'total_produk' => 0,
            'total_transaksi' => 0,
            'total_pendapatan' => 0,
            'stok_menipis' => 0,
        ];

        $topProducts = collect();
        $recentTransactions = collect();
        $lowStocks = collect();
        $categories = collect();
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $monthlySales = collect(array_fill(0, 12, 0));
        $monthlyMax = 1;
    }

    return view('dashboard', compact('stats', 'topProducts', 'recentTransactions', 'lowStocks', 'categories', 'months', 'monthlySales', 'monthlyMax'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/transaksi/buat', function () {
        try {
            $products = Produk::with(['kategori', 'stok'])
                ->latest('id_produk')
                ->limit(12)
                ->get();
        } catch (Throwable) {
            $products = collect();
        }

        return view('kasir.transaksi-create', compact('products'));
    })->name('transaksi.create');

    Route::get('/transaksi', function () {
        try {
            $transactions = Transaksi::with('pembayaran')
                ->latest('id_transaksi')
                ->paginate(10);
        } catch (Throwable) {
            $transactions = collect();
        }

        return view('kasir.transaksi-index', compact('transactions'));
    })->name('transaksi.index');

    Route::get('/pembayaran', function () {
        try {
            $payments = Pembayaran::with('transaksi')
                ->latest('id_pembayaran')
                ->paginate(10);
        } catch (Throwable) {
            $payments = collect();
        }

        return view('kasir.pembayaran-index', compact('payments'));
    })->name('pembayaran.index');

    Route::get('/produk', function () {
        try {
            $products = Produk::with(['kategori', 'stok'])
                ->latest('id_produk')
                ->paginate(12);
        } catch (Throwable) {
            $products = collect();
        }

        return view('kasir.produk-index', compact('products'));
    })->name('produk.index');

    Route::get('/stok', function () {
        try {
            $stocks = StokProduk::with('produk')
                ->orderBy('jumlah_stok')
                ->paginate(10);
        } catch (Throwable) {
            $stocks = collect();
        }

        return view('kasir.stok-index', compact('stocks'));
    })->name('stok.index');

    Route::match(['get', 'post'], '/ai-rekomendasi', function (Request $request) {
        $hasil = [];
        $data = [
            'budget' => $request->input('budget'),
            'tingkat_manis' => $request->input('tingkat_manis'),
            'alergi' => $request->input('alergi', 'Tidak Ada'),
            'keperluan' => $request->input('keperluan', 'Sarapan'),
        ];

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'budget' => ['required', 'numeric', 'min:0'],
                'tingkat_manis' => ['required', 'integer', 'min:1', 'max:10'],
                'alergi' => ['required', 'in:Tidak Ada,Gluten,Susu,Telur'],
                'keperluan' => ['required', 'in:Sarapan,Cemilan,Oleh-oleh,Hadiah'],
            ]);

            $service = new FuzzyTsukamotoService();

            $ranking = $service->proses(
                (float) $validated['budget'],
                (int) $validated['tingkat_manis'],
                $validated['alergi'],
                $validated['keperluan']
            );

            foreach ($ranking as $item) {
                $produk = Produk::where('nama_produk', $item['produk'])->first();

                $hasil[] = [
                    'produk' => $item['produk'],
                    'nilai' => $item['nilai'],
                    'harga' => $produk?->harga_jual,
                    'gambar' => $produk?->gambar,
                    'deskripsi' => $produk?->deskripsi,
                    'bobot' => $item['bobot'] ?? null,
                ];
            }

            $data = $validated;
        }

        return view('kasir.ai-rekomendasi', compact('hasil', 'data'));
    })->name('ai-rekomendasi');
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
