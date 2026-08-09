<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Floure Bakery</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @filamentStyles
    </head>
    <body class="font-sans antialiased">
        <div class="app-shell">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="app-main">
                <header class="content-navbar">
                    <div>
                        <p class="content-navbar-kicker">Floure Bakery</p>
                        <h1 class="content-navbar-title">Dashboard Kasir</h1>
                    </div>

                    <div class="content-navbar-actions">
                        <div x-data="{ profileOpen: false }" class="profile-menu">
                            <button type="button" class="profile-trigger" @click="profileOpen = ! profileOpen" @click.outside="profileOpen = false">
                                <span class="profile-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}</span>
                                <span class="profile-text">
                                    <span class="profile-name">{{ Auth::user()->name }}</span>
                                    <span class="profile-role">{{ ucfirst(Auth::user()->role ?? 'kasir') }}</span>
                                </span>
                                <svg class="profile-chevron" :class="{ 'is-open': profileOpen }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="profileOpen"
                                 x-transition.origin.top.right
                                 class="profile-dropdown"
                                 style="display: none;">
                                <div class="profile-dropdown-head">
                                    <span class="profile-avatar large">{{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}</span>
                                    <span>
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <small>{{ Auth::user()->email }}</small>
                                    </span>
                                </div>

                                @if (Route::has('profile.edit'))
                                    <a class="profile-dropdown-item" href="{{ route('profile.edit') }}">Profil</a>
                                @else
                                    <a class="profile-dropdown-item" href="{{ route('dashboard') }}">Profil</a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="profile-dropdown-item danger">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                {{ $slot }}
            </main>
        </div>
        
        @livewireScripts
        @filamentScripts
    </body>
</html>
