<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');

            $table->unsignedBigInteger('id_transaksi');

            $table->enum('metode_pembayaran', [
                'Tunai',
                'QRIS',
                'Debit',
                'Transfer'
            ]);

            $table->decimal('jumlah_dibayar', 15, 2);

            $table->decimal('jumlah_kembalian', 15, 2)
                ->default(0);

            $table->timestamp('tanggal_pembayaran')
                ->nullable()
                ->useCurrent();

            $table->timestamp('created_at')
                ->nullable()
                ->useCurrent();

            $table->timestamp('updated_at')
                ->nullable()
                ->useCurrent()
                ->useCurrentOnUpdate();

            $table->foreign('id_transaksi')
                ->references('id_transaksi')
                ->on('transaksi')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};