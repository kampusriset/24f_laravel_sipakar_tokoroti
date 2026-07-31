<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <h1 class="text-2xl font-bold">
                    Welcome,
                    {{ Auth::user()->name }}
                </h1>
                <p class="mt-3">
                    Role :
                    {{ ucfirst(Auth::user()->role) }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>