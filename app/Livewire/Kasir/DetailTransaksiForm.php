<?php

namespace App\Livewire\Kasir;

use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\Transaksi;
use Livewire\Component;

class DetailTransaksiForm extends Component
{
    public ?int $id_transaksi = null;
    public ?int $id_produk = null;
    public int $jumlah = 1;
    public float $harga_satuan = 0;
    public float $subtotal = 0;

    public function updatedIdProduk(?int $value): void
    {
        $produk = Produk::find($value);
        if ($produk) {
            $this->harga_satuan = (float) $produk->harga_jual;
            $this->subtotal = $this->harga_satuan * $this->jumlah;
        } else {
            $this->harga_satuan = 0;
            $this->subtotal = 0;
        }
    }

    public function updatedJumlah(int $value): void
    {
        $this->subtotal = $this->harga_satuan * max(1, $value);
    }

    public function create(): void
    {
        $this->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'id_produk'    => 'required|exists:produk,id_produk',
            'jumlah'       => 'required|integer|min:1',
        ], [
            'id_transaksi.required' => 'Transaksi harus dipilih.',
            'id_produk.required'    => 'Produk harus dipilih.',
        ]);

        DetailTransaksi::create([
            'id_transaksi' => $this->id_transaksi,
            'id_produk'    => $this->id_produk,
            'jumlah'       => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
            'subtotal'     => $this->subtotal,
        ]);

        session()->flash('status', 'Detail Transaksi berhasil ditambahkan.');
        $this->reset(['id_transaksi', 'id_produk', 'jumlah', 'harga_satuan', 'subtotal']);
        $this->jumlah = 1;
    }

    public function render()
    {
        return view('livewire.kasir.detail-transaksi-form', [
            'transaksis' => Transaksi::latest('id_transaksi')->get(['id_transaksi', 'tanggal_transaksi', 'status_transaksi']),
            'produks'    => Produk::orderBy('nama_produk')->get(['id_produk', 'nama_produk', 'harga_jual']),
        ]);
    }
}
