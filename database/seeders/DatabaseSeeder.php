<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\StokProduk;
use App\Models\BahanBaku;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USER / ADMIN / KASIR
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir1@gmail.com'],
            [
                'name' => 'Kasir 1',
                'password' => Hash::make('password'),
                'role' => 'kasir',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir2@gmail.com'],
            [
                'name' => 'Kasir 2',
                'password' => Hash::make('password'),
                'role' => 'kasir',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | PEGAWAI TOKO YAH
        |--------------------------------------------------------------------------
        */

        $pegawais = [
            [
                'nama_pegawai' => 'Administrator',
                'jabatan' => 'Admin',
                'no_telepon' => '081234567890',
                'alamat' => 'Surakarta',
            ],
            [
                'nama_pegawai' => 'Kasir 1',
                'jabatan' => 'Kasir',
                'no_telepon' => '081234567891',
                'alamat' => 'Surakarta',
            ],
            [
                'nama_pegawai' => 'Kasir 2',
                'jabatan' => 'Kasir',
                'no_telepon' => '081234567892',
                'alamat' => 'Surakarta',
            ],
        ];

        foreach ($pegawais as $pegawai) {
            Pegawai::updateOrCreate(
                ['nama_pegawai' => $pegawai['nama_pegawai']],
                $pegawai
            );
        }

        /*
        |--------------------------------------------------------------------------
        | KATEGORI PRODUK TOKO ROTI
        |--------------------------------------------------------------------------
        */

        $kategories = [
            [
                'nama_kategori' => 'Roti Tawar',
                'deskripsi_kategori' => 'Roti dengan tekstur lembut, biasa untuk sarapan',
            ],
            [
                'nama_kategori' => 'Roti Manis',
                'deskripsi_kategori' => 'Roti dengan isian coklat, keju, atau krim',
            ],
            [
                'nama_kategori' => 'Kue Kering',
                'deskripsi_kategori' => 'Kue kering seperti nastar, kastengel',
            ],
            [
                'nama_kategori' => 'Pastry',
                'deskripsi_kategori' => 'Croissant, Danish, puff pastry',
            ],
            [
                'nama_kategori' => 'Kue Basah',
                'deskripsi_kategori' => 'Brownies, bolu, lapis legit',
            ],
        ];

        foreach ($kategories as $kat) {
            KategoriProduk::updateOrCreate(
                ['nama_kategori' => $kat['nama_kategori']],
                $kat
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PRODUK TOKO ROTI
        |--------------------------------------------------------------------------
        */

        $produks = [
            [
                'nama_produk' => 'Roti Tawar Putih',
                'id_kategori' => 1,
                'harga_jual' => 18000,
                'deskripsi' => 'Roti tawar putih tanpa kulit, 500 gram',
                'stok' => 50,
            ],
            [
                'nama_produk' => 'Roti Tawar Gandum',
                'id_kategori' => 1,
                'harga_jual' => 22000,
                'deskripsi' => 'Roti tawar gandum utuh',
                'stok' => 30,
            ],
            [
                'nama_produk' => 'Roti Coklat',
                'id_kategori' => 2,
                'harga_jual' => 8000,
                'deskripsi' => 'Roti isi coklat',
                'stok' => 100,
            ],
            [
                'nama_produk' => 'Roti Keju',
                'id_kategori' => 2,
                'harga_jual' => 8500,
                'deskripsi' => 'Roti isi keju cheddar',
                'stok' => 80,
            ],
            [
                'nama_produk' => 'Nastar',
                'id_kategori' => 3,
                'harga_jual' => 45000,
                'deskripsi' => 'Kue nastar isi nanas',
                'stok' => 20,
            ],
            [
                'nama_produk' => 'Kastengel',
                'id_kategori' => 3,
                'harga_jual' => 50000,
                'deskripsi' => 'Kue keju gurih',
                'stok' => 15,
            ],
            [
                'nama_produk' => 'Croissant',
                'id_kategori' => 4,
                'harga_jual' => 12000,
                'deskripsi' => 'Croissant mentega',
                'stok' => 40,
            ],
            [
                'nama_produk' => 'Brownies Kukus',
                'id_kategori' => 5,
                'harga_jual' => 35000,
                'deskripsi' => 'Brownies kukus coklat',
                'stok' => 10,
            ],
            [
                'nama_produk' => 'Lapis Legit',
                'id_kategori' => 5,
                'harga_jual' => 12000,
                'deskripsi' => 'Lapis legit tradisional',
                'stok' => 5,
            ],
        ];

        foreach ($produks as $pData) {

            $stok = $pData['stok'];
            unset($pData['stok']);

            $produk = Produk::updateOrCreate(
                ['nama_produk' => $pData['nama_produk']],
                $pData
            );

            StokProduk::updateOrCreate(
                ['id_produk' => $produk->id_produk],
                [
                    'jumlah_stok' => $stok,
                    'tanggal_update' => now(),
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | BAHAN BAKU TOKO ROTI
        |--------------------------------------------------------------------------
        */

        $bahans = [
            [
                'nama_bahan' => 'Tepung Terigu Protein Tinggi',
                'satuan' => 'kg',
                'stok_saat_ini' => 50,
                'stok_minimum' => 10,
                'harga_per_satuan' => 12000,
            ],
            [
                'nama_bahan' => 'Tepung Terigu Serbaguna',
                'satuan' => 'kg',
                'stok_saat_ini' => 30,
                'stok_minimum' => 8,
                'harga_per_satuan' => 10000,
            ],
            [
                'nama_bahan' => 'Gula Pasir',
                'satuan' => 'kg',
                'stok_saat_ini' => 25,
                'stok_minimum' => 5,
                'harga_per_satuan' => 15000,
            ],
            [
                'nama_bahan' => 'Mentega',
                'satuan' => 'kg',
                'stok_saat_ini' => 15,
                'stok_minimum' => 3,
                'harga_per_satuan' => 45000,
            ],
            [
                'nama_bahan' => 'Telur Ayam',
                'satuan' => 'butir',
                'stok_saat_ini' => 200,
                'stok_minimum' => 50,
                'harga_per_satuan' => 2500,
            ],
            [
                'nama_bahan' => 'Susu Cair',
                'satuan' => 'liter',
                'stok_saat_ini' => 20,
                'stok_minimum' => 5,
                'harga_per_satuan' => 18000,
            ],
            [
                'nama_bahan' => 'Coklat Bubuk',
                'satuan' => 'kg',
                'stok_saat_ini' => 5,
                'stok_minimum' => 1,
                'harga_per_satuan' => 80000,
            ],
            [
                'nama_bahan' => 'Keju Cheddar',
                'satuan' => 'kg',
                'stok_saat_ini' => 8,
                'stok_minimum' => 2,
                'harga_per_satuan' => 90000,
            ],
            [
                'nama_bahan' => 'Selai Nanas',
                'satuan' => 'kg',
                'stok_saat_ini' => 10,
                'stok_minimum' => 2,
                'harga_per_satuan' => 35000,
            ],
            [
                'nama_bahan' => 'Ragi Instan',
                'satuan' => 'gram',
                'stok_saat_ini' => 1000,
                'stok_minimum' => 200,
                'harga_per_satuan' => 200,
            ],
        ];

        foreach ($bahans as $bahan) {
            BahanBaku::updateOrCreate(
                ['nama_bahan' => $bahan['nama_bahan']],
                $bahan
            );
        }
    }
}