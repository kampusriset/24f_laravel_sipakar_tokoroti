<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id('id_detail');

            $table->unsignedBigInteger('id_transaksi');

            $table->unsignedBigInteger('id_produk');

            $table->integer('jumlah');

            $table->decimal('harga_satuan', 15, 2);

            $table->decimal('subtotal', 15, 2);

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

            $table->foreign('id_produk')
                ->references('id_produk')
                ->on('produk')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};