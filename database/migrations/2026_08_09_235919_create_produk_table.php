<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');

            $table->string('nama_produk', 150);

            $table->unsignedBigInteger('id_kategori');

            $table->decimal('harga_jual', 15, 2);

            // Field untuk sistem rekomendasi AI
            $table->unsignedTinyInteger('tingkat_manis')->nullable();
            $table->string('alergi', 255)->nullable();
            $table->string('keperluan', 255)->nullable();

            $table->text('deskripsi')->nullable();

            $table->string('gambar', 255)->nullable();

            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori_produk')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};