<?php

namespace App\Exports;

use App\Models\StokProduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StokProdukExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return StokProduk::with('produk')
            ->orderBy('id_produk')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Jumlah Stok',
            'Tanggal Update',
        ];
    }

    public function map($stok): array
    {
        return [
            $stok->produk->nama_produk ?? '-',
            $stok->jumlah_stok,
            $stok->tanggal_update,
        ];
    }
}