<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');

            $table->timestamp('tanggal_transaksi')
                ->nullable()
                ->useCurrent();

            $table->unsignedBigInteger('id_pegawai');

            $table->decimal('total_bayar', 15, 2)
                ->default(0);

            $table->enum('status_transaksi', [
                'Pending',
                'Selesai',
                'Dibatalkan'
            ])->default('Selesai');

            $table->timestamp('created_at')
                ->nullable()
                ->useCurrent();

            $table->timestamp('updated_at')
                ->nullable()
                ->useCurrent()
                ->useCurrentOnUpdate();

            $table->foreign('id_pegawai')
                ->references('id_pegawai')
                ->on('pegawai')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};