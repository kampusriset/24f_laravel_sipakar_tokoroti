<?php

namespace App\Services;

use App\Models\Produk;

class FuzzyTsukamotoService
{
    /*
    |--------------------------------------------------------------------------
    | BUDGET
    |--------------------------------------------------------------------------
    */

    // Murah
    public function murah($budget)
    {
        if ($budget <= 20000) {
            return 1;
        }

        if ($budget >= 40000) {
            return 0;
        }

        return (40000 - $budget) / 20000;
    }

    // Sedang
    public function sedang($budget)
    {
        if ($budget <= 15000 || $budget >= 40000) {
            return 0;
        }

        if ($budget <= 27500) {
            return ($budget - 15000) / 12500;
        }

        return (40000 - $budget) / 12500;
    }

    // Mahal
    public function mahal($budget)
    {
        if ($budget <= 35000) {
            return 0;
        }

        if ($budget >= 60000) {
            return 1;
        }

        return ($budget - 35000) / 25000;
    }

    /*
    |--------------------------------------------------------------------------
    | TINGKAT MANIS
    |--------------------------------------------------------------------------
    */

    // Rendah
    public function manisRendah($nilai)
    {
        if ($nilai <= 4) {
            return 1;
        }

        if ($nilai >= 7) {
            return 0;
        }

        return (7 - $nilai) / 3;
    }

    // Sedang
    public function manisSedang($nilai)
    {
        if ($nilai <= 3 || $nilai >= 8) {
            return 0;
        }

        if ($nilai <= 5.5) {
            return ($nilai - 3) / 2.5;
        }

        return (8 - $nilai) / 2.5;
    }

    // Tinggi
    public function manisTinggi($nilai)
    {
        if ($nilai <= 6) {
            return 0;
        }

        if ($nilai >= 10) {
            return 1;
        }

        return ($nilai - 6) / 4;
    }

    /*
    |--------------------------------------------------------------------------
    | ALERGI
    |--------------------------------------------------------------------------
    */

    private function alergi($input, $produk)
    {
        // User tidak punya alergi
        if ($input == 'Tidak Ada') {
            return 1;
        }

        // Produk aman (tidak mengandung alergen)
        if ($produk == 'Tidak Ada') {
            return 1;
        }

        // Produk mengandung alergen yang sama
        if ($input == $produk) {
            return 0;
        }

        return 1;
    }

    /*
    |--------------------------------------------------------------------------
    | KEPERLUAN
    |--------------------------------------------------------------------------
    */

    private function keperluan($input, $produk)
    {
        if ($input == $produk) {
            return 1;
        }

        // Produk masih mungkin direkomendasikan,
        // hanya prioritasnya lebih rendah.
        return 0.4;
    }

    /*
    |--------------------------------------------------------------------------
    | OUTPUT FUZZY (TSUKAMOTO)
    |--------------------------------------------------------------------------
    */

    // Konsekuen Tinggi
    private function zTinggi($alpha)
    {
        return 50 + ($alpha * 50);
    }

    // Konsekuen Sedang
    private function zSedang($alpha)
    {
        return 75 - ($alpha * 25);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER MEMBERSHIP
    |--------------------------------------------------------------------------
    */

    private function membershipBudget(string $kategori, float $budget): float
    {
        return match ($kategori) {
            'murah' => $this->murah($budget),
            'sedang' => $this->sedang($budget),
            'mahal' => $this->mahal($budget),
            default => 0,
        };
    }

    private function membershipManis(string $kategori, int $nilai): float
    {
        return match ($kategori) {
            'rendah' => $this->manisRendah($nilai),
            'sedang' => $this->manisSedang($nilai),
            'tinggi' => $this->manisTinggi($nilai),
            default => 0,
        };
    }

    private function membershipAlergi(string $input, string $produk): float
    {
        return $this->alergi($input, $produk);
    }

    private function membershipKeperluan(string $input, string $produk): float
    {
        return $this->keperluan($input, $produk);
    }

    /*
    |--------------------------------------------------------------------------
    | RULE BASE
    |--------------------------------------------------------------------------
    */

    private array $rules = [

    /*
    |--------------------------------------------------------------------------
    | ROTI COKLAT
    |--------------------------------------------------------------------------
    */

    [
        'produk'=>'Roti Coklat',
        'budget'=>'murah',
        'manis'=>'tinggi',
        'alergi'=>'Gluten',
        'keperluan'=>'Cemilan',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Roti Coklat',
        'budget'=>'sedang',
        'manis'=>'tinggi',
        'alergi'=>'Gluten',
        'keperluan'=>'Cemilan',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Roti Coklat',
        'budget'=>'murah',
        'manis'=>'sedang',
        'alergi'=>'Gluten',
        'keperluan'=>'Cemilan',
        'output'=>'sedang',
    ],

    [
        'produk'=>'Roti Coklat',
        'budget'=>'sedang',
        'manis'=>'sedang',
        'alergi'=>'Gluten',
        'keperluan'=>'Cemilan',
        'output'=>'sedang',
    ],

    /*
    |--------------------------------------------------------------------------
    | ROTI KEJU
    |--------------------------------------------------------------------------
    */

    [
        'produk'=>'Roti Keju',
        'budget'=>'murah',
        'manis'=>'sedang',
        'alergi'=>'Susu',
        'keperluan'=>'Cemilan',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Roti Keju',
        'budget'=>'sedang',
        'manis'=>'sedang',
        'alergi'=>'Susu',
        'keperluan'=>'Cemilan',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Roti Keju',
        'budget'=>'murah',
        'manis'=>'tinggi',
        'alergi'=>'Susu',
        'keperluan'=>'Sarapan',
        'output'=>'sedang',
    ],

    [
        'produk'=>'Roti Keju',
        'budget'=>'murah',
        'manis'=>'sedang',
        'alergi'=>'Susu',
        'keperluan'=>'Sarapan',
        'output'=>'sedang',
    ],

    /*
    |--------------------------------------------------------------------------
    | ROTI TAWAR PUTIH
    |--------------------------------------------------------------------------
    */

    [
        'produk'=>'Roti Tawar Putih',
        'budget'=>'murah',
        'manis'=>'rendah',
        'alergi'=>'Gluten',
        'keperluan'=>'Sarapan',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Roti Tawar Putih',
        'budget'=>'murah',
        'manis'=>'sedang',
        'alergi'=>'Gluten',
        'keperluan'=>'Sarapan',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Roti Tawar Putih',
        'budget'=>'sedang',
        'manis'=>'rendah',
        'alergi'=>'Gluten',
        'keperluan'=>'Sarapan',
        'output'=>'sedang',
    ],

    /*
    |--------------------------------------------------------------------------
    | ROTI TAWAR GANDUM
    |--------------------------------------------------------------------------
    */

    [
        'produk'=>'Roti Tawar Gandum',
        'budget'=>'sedang',
        'manis'=>'rendah',
        'alergi'=>'Gluten',
        'keperluan'=>'Sarapan',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Roti Tawar Gandum',
        'budget'=>'sedang',
        'manis'=>'sedang',
        'alergi'=>'Gluten',
        'keperluan'=>'Sarapan',
        'output'=>'sedang',
    ],

    [
        'produk'=>'Roti Tawar Gandum',
        'budget'=>'sedang',
        'manis'=>'rendah',
        'alergi'=>'Gluten',
        'keperluan'=>'Sarapan',
        'output'=>'sedang',
    ],

    /*
    |--------------------------------------------------------------------------
    | CROISSANT
    |--------------------------------------------------------------------------
    */

    [
        'produk'=>'Croissant',
        'budget'=>'murah',
        'manis'=>'rendah',
        'alergi'=>'Gluten',
        'keperluan'=>'Sarapan',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Croissant',
        'budget'=>'murah',
        'manis'=>'sedang',
        'alergi'=>'Gluten',
        'keperluan'=>'Sarapan',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Croissant',
        'budget'=>'sedang',
        'manis'=>'sedang',
        'alergi'=>'Gluten',
        'keperluan'=>'Sarapan',
        'output'=>'sedang',
    ],

    [
        'produk'=>'Croissant',
        'budget'=>'murah',
        'manis'=>'rendah',
        'alergi'=>'Gluten',
        'keperluan'=>'Cemilan',
        'output'=>'sedang',
    ],

    /*
    |--------------------------------------------------------------------------
    | BROWNIES KUKUS
    |--------------------------------------------------------------------------
    */

    [
        'produk'=>'Brownies Kukus',
        'budget'=>'sedang',
        'manis'=>'tinggi',
        'alergi'=>'Telur',
        'keperluan'=>'Hadiah',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Brownies Kukus',
        'budget'=>'mahal',
        'manis'=>'tinggi',
        'alergi'=>'Telur',
        'keperluan'=>'Hadiah',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Brownies Kukus',
        'budget'=>'sedang',
        'manis'=>'sedang',
        'alergi'=>'Telur',
        'keperluan'=>'Hadiah',
        'output'=>'sedang',
    ],

    [
        'produk'=>'Brownies Kukus',
        'budget'=>'mahal',
        'manis'=>'sedang',
        'alergi'=>'Telur',
        'keperluan'=>'Hadiah',
        'output'=>'sedang',
    ],

    /*
    |--------------------------------------------------------------------------
    | NASTAR
    |--------------------------------------------------------------------------
    */

    [
        'produk'=>'Nastar',
        'budget'=>'mahal',
        'manis'=>'tinggi',
        'alergi'=>'Gluten',
        'keperluan'=>'Oleh-oleh',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Nastar',
        'budget'=>'mahal',
        'manis'=>'sedang',
        'alergi'=>'Gluten',
        'keperluan'=>'Oleh-oleh',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Nastar',
        'budget'=>'sedang',
        'manis'=>'tinggi',
        'alergi'=>'Gluten',
        'keperluan'=>'Hadiah',
        'output'=>'sedang',
    ],

    [
        'produk'=>'Nastar',
        'budget'=>'mahal',
        'manis'=>'rendah',
        'alergi'=>'Gluten',
        'keperluan'=>'Oleh-oleh',
        'output'=>'sedang',
    ],

    /*
    |--------------------------------------------------------------------------
    | KASTENGEL
    |--------------------------------------------------------------------------
    */

    [
        'produk'=>'Kastengel',
        'budget'=>'mahal',
        'manis'=>'rendah',
        'alergi'=>'Susu',
        'keperluan'=>'Oleh-oleh',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Kastengel',
        'budget'=>'mahal',
        'manis'=>'sedang',
        'alergi'=>'Susu',
        'keperluan'=>'Oleh-oleh',
        'output'=>'sedang',
    ],

    [
        'produk'=>'Kastengel',
        'budget'=>'sedang',
        'manis'=>'rendah',
        'alergi'=>'Susu',
        'keperluan'=>'Hadiah',
        'output'=>'sedang',
    ],

    /*
    |--------------------------------------------------------------------------
    | LAPIS LEGIT
    |--------------------------------------------------------------------------
    */

    [
        'produk'=>'Lapis Legit',
        'budget'=>'mahal',
        'manis'=>'tinggi',
        'alergi'=>'Gluten',
        'keperluan'=>'Oleh-oleh',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Lapis Legit',
        'budget'=>'mahal',
        'manis'=>'sedang',
        'alergi'=>'Gluten',
        'keperluan'=>'Oleh-oleh',
        'output'=>'tinggi',
    ],

    [
        'produk'=>'Lapis Legit',
        'budget'=>'mahal',
        'manis'=>'tinggi',
        'alergi'=>'Gluten',
        'keperluan'=>'Hadiah',
        'output'=>'sedang',
    ],

    [
        'produk'=>'Lapis Legit',
        'budget'=>'sedang',
        'manis'=>'tinggi',
        'alergi'=>'Gluten',
        'keperluan'=>'Hadiah',
        'output'=>'sedang'
    ],

];

    /*
    |--------------------------------------------------------------------------
    | INFERENSI
    |--------------------------------------------------------------------------
    */

    public function rekomendasi(
        float $budget,
        int $tingkatManis,
        string $alergi,
        string $keperluan
    ): array {

        $hasilRule = [];

        foreach ($this->rules as $rule) {

            // membership budget
            $budgetValue = $this->membershipBudget(
                $rule['budget'],
                $budget
            );

            // membership tingkat manis
            $manisValue = $this->membershipManis(
                $rule['manis'],
                $tingkatManis
            );

            // membership alergi
            $alergiValue = isset($rule['alergi'])
                ? $this->membershipAlergi($alergi, $rule['alergi'])
                : 1;

            // membership keperluan
            $keperluanValue = isset($rule['keperluan'])
                ? $this->membershipKeperluan($keperluan, $rule['keperluan'])
                : 1;

            // Hitung alpha dasar
            $alpha = min(
                $budgetValue,
                $manisValue,
                $alergiValue
            );

            $alpha *= $keperluanValue;

            // Maksimal 1
            $alpha = min($alpha, 1);

            // Jika alpha = 0, rule tidak aktif
            if ($alpha <= 0) {
                continue;
            }

            // Hitung nilai z
            $z = $rule['output'] === 'tinggi'
                ? $this->zTinggi($alpha)
                : $this->zSedang($alpha);

            // Simpan hasil rule
            $hasilRule[] = [
                'produk' => $rule['produk'] ?? null,
                'alpha' => $alpha,
                'z' => $z,
                'output' => $rule['output'],
            ];

        }

        return $hasilRule;
    }

    /*
    |--------------------------------------------------------------------------
    | DEFUZZIFIKASI
    |--------------------------------------------------------------------------
    */

    private function defuzzifikasi(array $hasilRule): float
    {
        $atas = 0;
        $bawah = 0;

        foreach ($hasilRule as $rule) {

            $atas += $rule['alpha'] * $rule['z'];

            $bawah += $rule['alpha'];
        }

        if ($bawah == 0) {
            return 0;
        }

        return $atas / $bawah;
    }

    /*
    |--------------------------------------------------------------------------
    | RANKING PRODUK
    |--------------------------------------------------------------------------
    */

    public function proses(
        float $budget,
        int $tingkatManis,
        string $alergi,
        string $keperluan
    ): array {

        // Inferensi
        $hasilRule = $this->rekomendasi(
            $budget,
            $tingkatManis,
            $alergi,
            $keperluan
        );

        if (count($hasilRule) === 0) {
        return [];
        }

        // Kelompokkan berdasarkan produk
        $produk = [];

        foreach ($hasilRule as $rule) {

            if (!$rule['produk']) {
                continue;
            }

            if (!isset($produk[$rule['produk']])) {

                $produk[$rule['produk']] = [
                    'atas' => 0,
                    'bawah' => 0,
                ];
            }

            $produk[$rule['produk']]['atas'] +=
                $rule['alpha'] * $rule['z'];

            $produk[$rule['produk']]['bawah'] +=
                $rule['alpha'];
        }

        $ranking = [];

        foreach ($produk as $nama => $nilai) {

            if ($nilai['bawah'] == 0) {
                continue;
            }

            $dataProduk = Produk::where('nama_produk', $nama)->first();

            $ranking[] = [
                'produk' => $nama,
                'nilai' => round(
                    $nilai['atas'] / $nilai['bawah'],
                    2
                ),
                'bobot' => round($nilai['bawah'], 4),
            ];
        }

        usort($ranking, function ($a, $b) {
            // Prioritas pertama: jumlah alpha
            if ($a['bobot'] != $b['bobot']) {
                return $b['bobot'] <=> $a['bobot'];
            }

            // Kalau bobot sama, baru lihat nilai Tsukamoto
            return $b['nilai'] <=> $a['nilai'];
        });

        return array_slice($ranking, 0, 3);
    }
}