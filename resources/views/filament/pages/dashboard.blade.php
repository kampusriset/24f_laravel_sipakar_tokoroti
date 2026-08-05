<x-filament-panels::page>
    {{-- Welcome Card --}}
    <x-filament::section>
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            {{-- Left side: Welcome message --}}
            <div class="flex items-center space-x-4 w-full sm:w-auto">
                {{-- Avatar jika ada --}}
                @if($this->getUserAvatar())
                    <img 
                        src="{{ $this->getUserAvatar() }}" 
                        alt="{{ $this->getUserName() }}"
                        class="w-12 h-12 rounded-full border-2 border-[#F59E0B] object-cover"
                    >
                @else
                    {{-- Default avatar dengan inisial --}}
                    <div class="w-12 h-12 rounded-full bg-[#F59E0B] flex items-center justify-center text-[#6B4226] font-bold text-xl">
                        {{ substr($this->getUserName(), 0, 1) }}
                    </div>
                @endif

                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-[#6B4226]">
                        Selamat Datang, {{ $this->getUserName() }}! 🍞
                    </h2>
                    <p class="text-xs sm:text-sm text-[#A9754F]">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </p>
                </div>
            </div>

            {{-- Right side: Sign Out button --}}
            <div class="w-full sm:w-auto">
                <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
                    @csrf
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-[#6B4226] hover:bg-[#8C5A35] text-white text-sm font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#F59E0B] focus:ring-offset-2"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </x-filament::section>

    {{-- Spacer --}}
    <div class="h-6"></div>

    {{-- Dashboard Widgets Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Render semua widgets --}}
        @foreach($this->getWidgets() as $widget)
            <div class="col-span-1">
                @livewire($widget)
            </div>
        @endforeach
    </div>
</x-filament-panels::page>