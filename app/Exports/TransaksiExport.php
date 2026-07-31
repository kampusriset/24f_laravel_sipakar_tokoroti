<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Transaksi::with('pegawai')
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal Transaksi',
            'Kasir',
            'Total Bayar',
            'Status',
        ];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->tanggal_transaksi,
            $transaksi->pegawai->nama_pegawai ?? '-',
            $transaksi->total_bayar,
            $transaksi->status_transaksi,
        ];
    }
}