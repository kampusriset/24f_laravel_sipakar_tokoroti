<?php

namespace App\Livewire\Kasir;

use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;

class TransaksiList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status_transaksi !== 'Pending') {
            session()->flash('error', 'Hanya transaksi berstatus Pending yang dapat dihapus.');
            return;
        }

        \DB::transaction(function () use ($transaksi) {
            $transaksi->detail()->delete();
            $transaksi->delete();
        });

        session()->flash('status', 'Transaksi berhasil dihapus.');
    }

    public function render()
    {
        $query = Transaksi::with('pembayaran')->latest('id_transaksi');

        if ($this->statusFilter) {
            $query->where('status_transaksi', $this->statusFilter);
        }

        if ($this->search) {
            $query->where('id_transaksi', 'like', "%{$this->search}%");
        }

        return view('livewire.kasir.transaksi-list', [
            'transactions' => $query->paginate(10),
        ]);
    }
}
