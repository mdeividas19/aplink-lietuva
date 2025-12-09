<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl sm:text-2xl text-black leading-tight">
            {{ __('Suvestinė') }}
        </h2>
    </x-slot>

    <div class="py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white bg-amber overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black">
                    {{ __("Jūs sėkmingai prisijungėte!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
