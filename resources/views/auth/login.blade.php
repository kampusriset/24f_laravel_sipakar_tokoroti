<x-guest-layout>
    <div class="auth-brand">
        <div class="auth-mark">F</div>
        <div>
            <h1 class="auth-title">Floure <span>Bakery</span></h1>
            <p class="auth-subtitle">Akses khusus Kasir dan Admin toko.</p>
        </div>
    </div>

    @if(session('error'))
        <div class="auth-alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="auth-field">
            <x-input-label for="email" value="Email / No Hp" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Masukkan Email atau Nomor Hp" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="auth-field">
            <x-input-label for="password" value="Kata Sandi" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder="Masukkan Kata Sandi"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="auth-link-row">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Lupa Kata Sandi
                </a>
            @endif
        </div>

        <button type="submit" class="auth-button">Masuk sebagai Kasir/Admin</button>
    </form>

    <p class="auth-note">Halaman ini hanya untuk Kasir dan Admin. Pelanggan dapat memesan melalui halaman produk tanpa login.</p>

    <div class="auth-divider">atau</div>

    <div>
        <form action="/auth/google" method="GET">
            <button type="submit" class="google-button">
                <span class="google-icon">G</span>
                Login dengan Google
            </button>
        </form>
    </div>
</x-guest-layout>
