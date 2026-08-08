<x-app-layout>
    @include('kasir.partials.styles')

    <style>
        .ai-layout {
            display: grid;
            grid-template-columns: minmax(320px, .72fr) minmax(0, 1.28fr);
            gap: 1rem;
            align-items: start;
        }

        .ai-form {
            display: grid;
            gap: 1rem;
            padding: 1.15rem;
        }

        .ai-field {
            display: grid;
            gap: .45rem;
        }

        .ai-field label {
            color: #4f3828;
            font-size: .84rem;
            font-weight: 950;
        }

        .ai-field input,
        .ai-field select {
            width: 100%;
            min-height: 3rem;
            padding: .8rem .9rem;
            border: 1px solid #ead8c4;
            border-radius: .85rem;
            background: #fffdf9;
            color: #2f2117;
            font: inherit;
            font-weight: 750;
            outline: none;
        }

        .ai-field input:focus,
        .ai-field select:focus {
            border-color: #d9843a;
            box-shadow: 0 0 0 4px rgba(217, 132, 58, .16);
        }

        .ai-error {
            color: #be123c;
            font-size: .78rem;
            font-weight: 800;
        }

        .ai-submit {
            min-height: 3rem;
            border: 0;
            border-radius: .9rem;
            background: linear-gradient(135deg, #15803d, #14532d);
            color: #fff;
            cursor: pointer;
            font: inherit;
            font-size: .9rem;
            font-weight: 950;
            box-shadow: 0 14px 28px rgba(20, 83, 45, .18);
        }

        .recommend-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
            padding: 1rem;
        }

        .recommend-card {
            position: relative;
            display: grid;
            gap: .75rem;
            justify-items: center;
            min-height: 18rem;
            padding: 1.15rem;
            border: 1px solid rgba(133, 91, 58, .14);
            border-radius: 1rem;
            background: linear-gradient(180deg, #fffdf9, #fff8ed);
            text-align: center;
        }

        .recommend-rank {
            font-size: 2.1rem;
            line-height: 1;
        }

        .recommend-image,
        .recommend-placeholder {
            display: grid;
            width: 5.25rem;
            height: 5.25rem;
            place-items: center;
            border-radius: 1rem;
            object-fit: cover;
            box-shadow: 0 12px 24px rgba(91, 54, 28, .12);
        }

        .recommend-placeholder {
            background: linear-gradient(135deg, #fff1d7, #e89a4c);
            color: #4b260f;
            font-size: 1.4rem;
            font-weight: 950;
        }

        .recommend-name {
            margin: 0;
            color: #2f2117;
            font-size: 1.05rem;
            font-weight: 950;
        }

        .recommend-price {
            color: #15803d;
            font-weight: 950;
        }

        .recommend-desc {
            margin: 0;
            color: #806d5f;
            font-size: .78rem;
            font-weight: 650;
            line-height: 1.5;
        }

        .fuzzy-box {
            width: 100%;
            margin-top: auto;
            padding-top: .8rem;
            border-top: 1px solid rgba(133, 91, 58, .12);
        }

        .fuzzy-label {
            color: #8b7868;
            font-size: .72rem;
            font-weight: 900;
        }

        .fuzzy-value {
            margin-top: .12rem;
            color: #b45309;
            font-size: 1.45rem;
            font-weight: 950;
        }

        .ai-summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: .7rem;
            margin-bottom: 1rem;
        }

        .ai-summary-item {
            padding: .8rem;
            border: 1px solid rgba(133, 91, 58, .12);
            border-radius: .9rem;
            background: #fffdf9;
        }

        .ai-summary-item span {
            display: block;
            color: #8b7868;
            font-size: .72rem;
            font-weight: 900;
        }

        .ai-summary-item strong {
            display: block;
            margin-top: .2rem;
            color: #2f2117;
            font-size: .9rem;
            font-weight: 950;
        }

        @media (max-width: 1180px) {
            .ai-layout {
                grid-template-columns: 1fr;
            }

            .recommend-grid,
            .ai-summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .recommend-grid,
            .ai-summary {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="kasir-page">
        <div class="kasir-wrap">
            <header class="kasir-head">
                <div>
                    <p class="kasir-kicker">Artificial Intelligence</p>
                    <h1 class="kasir-title">AI Rekomendasi Produk</h1>
                    <p class="kasir-subtitle">Versi Breeze dari halaman Filament: input preferensi, lalu tampilkan Top 3 rekomendasi produk.</p>
                </div>
            </header>

            <section class="ai-layout">
                <article class="kasir-card">
                    <div class="kasir-card-head">
                        <h2 class="kasir-card-title">Form Input</h2>
                        <span class="kasir-pill">Fuzzy Tsukamoto</span>
                    </div>

                    <form class="ai-form" method="POST" action="{{ route('kasir.ai-rekomendasi') }}">
                        @csrf

                        <div class="ai-field">
                            <label for="budget">Budget</label>
                            <input id="budget" name="budget" type="number" min="0" placeholder="Contoh: 25000" value="{{ old('budget', $data['budget']) }}" required>
                            @error('budget') <div class="ai-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="ai-field">
                            <label for="tingkat_manis">Tingkat Manis</label>
                            <select id="tingkat_manis" name="tingkat_manis" required>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" @selected((string) old('tingkat_manis', $data['tingkat_manis']) === (string) $i)>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('tingkat_manis') <div class="ai-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="ai-field">
                            <label for="alergi">Alergi</label>
                            <select id="alergi" name="alergi" required>
                                @foreach(['Tidak Ada', 'Gluten', 'Susu', 'Telur'] as $option)
                                    <option value="{{ $option }}" @selected(old('alergi', $data['alergi']) === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('alergi') <div class="ai-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="ai-field">
                            <label for="keperluan">Keperluan</label>
                            <select id="keperluan" name="keperluan" required>
                                @foreach(['Sarapan', 'Cemilan', 'Oleh-oleh', 'Hadiah'] as $option)
                                    <option value="{{ $option }}" @selected(old('keperluan', $data['keperluan']) === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('keperluan') <div class="ai-error">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="ai-submit">Cari Rekomendasi</button>
                    </form>
                </article>

                <article class="kasir-card">
                    <div class="kasir-card-head">
                        <h2 class="kasir-card-title">Top 3 Rekomendasi Produk</h2>
                        <span class="kasir-pill">{{ count($hasil) }} hasil</span>
                    </div>

                    @if(count($hasil))
                        <div class="ai-summary" style="padding: 1rem 1rem 0;">
                            <div class="ai-summary-item"><span>Budget</span><strong>Rp {{ number_format((float) $data['budget'], 0, ',', '.') }}</strong></div>
                            <div class="ai-summary-item"><span>Manis</span><strong>{{ $data['tingkat_manis'] }}/10</strong></div>
                            <div class="ai-summary-item"><span>Alergi</span><strong>{{ $data['alergi'] }}</strong></div>
                            <div class="ai-summary-item"><span>Keperluan</span><strong>{{ $data['keperluan'] }}</strong></div>
                        </div>

                        <div class="recommend-grid">
                            @foreach($hasil as $index => $item)
                                <div class="recommend-card">
                                    <div class="recommend-rank">{{ ['🥇', '🥈', '🥉'][$index] ?? '✨' }}</div>

                                    @if(!empty($item['gambar']))
                                        <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['produk'] }}" class="recommend-image">
                                    @else
                                        <div class="recommend-placeholder">{{ strtoupper(substr($item['produk'], 0, 1)) }}</div>
                                    @endif

                                    <h3 class="recommend-name">{{ $item['produk'] }}</h3>

                                    <div class="recommend-price">
                                        Rp {{ number_format((float) ($item['harga'] ?? 0), 0, ',', '.') }}
                                    </div>

                                    @if(!empty($item['deskripsi']))
                                        <p class="recommend-desc">{{ $item['deskripsi'] }}</p>
                                    @endif

                                    <div class="fuzzy-box">
                                        <div class="fuzzy-label">Nilai Fuzzy</div>
                                        <div class="fuzzy-value">{{ $item['nilai'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="kasir-empty">Isi form lalu klik Cari Rekomendasi untuk melihat Top 3 produk.</div>
                    @endif
                </article>
            </section>
        </div>
    </div>
</x-app-layout>
