<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->unsignedTinyInteger('tingkat_manis')
                ->nullable()
                ->after('harga_jual');

            $table->string('alergi')
                ->nullable()
                ->after('tingkat_manis');

            $table->string('keperluan')
                ->nullable()
                ->after('alergi');
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn([
                'tingkat_manis',
                'alergi',
                'keperluan',
            ]);
        });
    }
};