<x-filament-panels::page>

    {{-- FORM INPUT --}}
    {{ $this->form }}

    <div class="mt-6">
        <x-filament::button
            wire:click="cariRekomendasi"
            color="success"
            size="lg"
        >
            🔍 Cari Rekomendasi
        </x-filament::button>
    </div>

    @if(count($hasil))

        <div class="mt-8">

            <h2 class="text-xl font-bold mb-4">
                Top 3 Rekomendasi Produk
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                @foreach($hasil as $index => $item)

                    <x-filament::card>

                        <div class="text-center">

                            {{-- Ranking --}}
                            @if($index == 0)
                                <div class="text-3xl">🥇</div>
                            @elseif($index == 1)
                                <div class="text-3xl">🥈</div>
                            @else
                                <div class="text-3xl">🥉</div>
                            @endif

                            {{-- Gambar Produk --}}
                            @if(!empty($item['gambar']))
                                <img
                                    src="{{ asset('storage/' . $item['gambar']) }}"
                                    alt="{{ $item['produk'] }}"
                                    class="w-20 h-20 object-cover rounded-lg mx-auto mt-3 shadow-md"
                                >
                            @endif

                            {{-- Nama Produk --}}
                            <h3 class="text-lg font-bold mt-3">
                                {{ $item['produk'] }}
                            </h3>

                            {{-- Harga --}}
                            <div class="text-green-600 font-semibold mt-1">
                                💰 Rp {{ number_format($item['harga'], 0, ',', '.') }}
                            </div>

                            {{-- Deskripsi --}}
                            @if(!empty($item['deskripsi']))
                                <p class="text-xs text-gray-500 mt-2 px-2 leading-relaxed">
                                    {{ $item['deskripsi'] }}
                                </p>
                            @endif

                            <hr class="my-3">

                            {{-- Nilai Fuzzy --}}
                            <div class="text-xs text-gray-500">
                                Nilai Fuzzy
                            </div>

                            <div class="text-xl font-bold text-primary-600 mt-1">
                                {{ $item['nilai'] }}
                            </div>

                        </div>

                    </x-filament::card>

                @endforeach

            </div>

        </div>

    @endif

</x-filament-panels::page>