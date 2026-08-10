<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->id('id_bahan');

            $table->string('nama_bahan', 150);

            $table->string('satuan', 50);

            $table->integer('stok_saat_ini');

            $table->integer('stok_minimum');

            $table->decimal('harga_per_satuan', 15, 2);

            $table->timestamp('created_at')
                ->nullable()
                ->useCurrent();

            $table->timestamp('updated_at')
                ->nullable()
                ->useCurrent()
                ->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bahan_baku');
    }
};