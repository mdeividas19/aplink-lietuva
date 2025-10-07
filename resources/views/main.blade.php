<x-app-layout>
    <div class="relative bg-gray-800">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="img/vilnius-main.jpg" alt="Landscape of Lithuania">
            <div class="absolute inset-0 bg-gray-900 bg-opacity-50 mix-blend-multiply" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Atraskite Lietuvą</h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl mx-auto">Interaktyvus gidas po gražiausias Lietuvos vietas.</p>
        </div>
    </div>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Visos kelionių kryptys</h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Pasirinkite miestą ir pradėkite savo kelionę.</p>
        </div>

        @if($cities->isNotEmpty())
            {{-- Simplified grid for a list layout --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-6 text-lg text-gray-700 dark:text-gray-300">
                @foreach($cities as $city)
                    <div class="py-1">
                        {{-- Simple text link instead of a card-wrapped block --}}
                        <a href="{{ route('cities.show', $city) }}" 
                           class="hover:text-gray-900 dark:hover:text-white transition duration-150 ease-in-out font-medium">
                            {{ $city->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            {{-- This "no cities" block is now also simpler, matching the new style --}}
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-center text-gray-900 dark:text-gray-100">
                    <p>Atleiskite, šiuo metu miestų sąrašas tuščias.</p>
                </div>
            </div>
        @endif

    </div>
</div>
     <div class="mt-20">
                <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden md:flex">
                    <div class="md:w-1/2">
                        {{-- TODO: Replace with the image of the Place of the Day --}}
                        <img class="h-64 w-full object-cover md:h-full" src="img/nidos_kopos.jpg" alt="Nidos kopos">
                    </div>
                    <div class="p-8 md:w-1/2 flex flex-col justify-center">
                        <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Dienos Vieta</p>
                        <h3 class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white">Nidos kopos</h3>
                        <p class="mt-4 text-gray-600 dark:text-gray-400">Atraskite Parnidžio kopą Nidoje – vieną įspūdingiausių vietų Kuršių nerijoje, kur smėlis ir marios susitinka su dangumi, o saulės laikrodis skaičiuoja nepamirštamas akimirkas.</p>
                        <div class="mt-6">
                            {{-- TODO: In the future, this will link to the place's page --}}
                            <a href="#" class="inline-block bg-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">
                                Žiūrėti Daugiau
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-20 text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Jūsų Atrasta Lietuva</h2>
                <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-600 dark:text-gray-400">Šis gidas yra kuriamas keliautojų. Pasidalinkite savo nuotykiais, patarimais ir atraskite kitų bendruomenės narių istorijas apie nepamirštamas keliones po mūsų šalį.</p>
                <div class="mt-6">
                     {{-- TODO: In the future, this will link to the stories index page --}}
                    <a href="#" class="inline-block bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-900 font-bold py-3 px-8 rounded-lg hover:bg-gray-700 dark:hover:bg-white transition duration-300">
                        Skaityti Istorijas
                    </a>
                </div>
            </div>
</x-app-layout>