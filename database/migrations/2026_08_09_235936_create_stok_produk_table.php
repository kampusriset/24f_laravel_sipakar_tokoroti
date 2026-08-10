<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stok_produk', function (Blueprint $table) {
            $table->id('id_stok_produk');

            $table->unsignedBigInteger('id_produk');

            $table->integer('jumlah_stok');

            $table->timestamp('tanggal_update')
                ->nullable()
                ->useCurrent();

            $table->foreign('id_produk')
                ->references('id_produk')
                ->on('produk')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_produk');
    }
};