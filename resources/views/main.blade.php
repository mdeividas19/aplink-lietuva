<x-app-layout>
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="img/vilnius-main.jpg" alt="Landscape of Lithuania">
            <div class="absolute inset-0 bg-gradient-to-br from-baltic-blue via-baltic-blue/80 to-forest-green/70" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-32 px-4 sm:py-40 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight text-white mb-6 animate-fade-in">
                    Aplink Lietuvą
                </h1>
                <p class="mt-6 text-xl md:text-2xl text-amber-50 max-w-3xl mx-auto leading-relaxed">
                    Interaktyvus gidas po gražiausias Lietuvos vietas
                </p>
                <div class="mt-10">
                    <a href="#cities" class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-full bg-amber-500 text-white hover:bg-amber-600 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                        Pradėti kelionę
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="#F9FAFB"/>
            </svg>
        </div>
    </div>

    <!-- Cities Section -->
    <div id="cities" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-forest-green mb-4">
                    Visos kelionių kryptys
                </h2>
                <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto">
                    Pasirinkite miestą ir pradėkite savo kelionę po nuostabią Lietuvą
                </p>
                <div class="mt-6 w-24 h-1 bg-amber-500 mx-auto rounded-full"></div>
            </div>

            @if($cities->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($cities as $city)
                        <a href="{{ route('cities.show', $city) }}" 
                           class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-baltic-blue transition-colors duration-300">
                                        {{ $city->name }}
                                    </h3>
                                    <svg class="w-6 h-6 text-amber-500 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <div class="mt-4 w-12 h-1 bg-gradient-to-r from-amber-500 to-amber-300 rounded-full group-hover:w-full transition-all duration-500"></div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-md p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <p class="text-gray-600 text-lg">Atleiskite, šiuo metu miestų sąrašas tuščias.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Place of the Day Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-forest-green to-baltic-blue rounded-3xl shadow-2xl overflow-hidden">
                <div class="grid md:grid-cols-2 gap-0">
                    <div class="relative h-80 md:h-auto">
                        <img class="absolute inset-0 w-full h-full object-cover" src="img/nidos_kopos.jpg" alt="Nidos kopos">
                        <div class="absolute top-6 left-6">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-amber-500 text-white shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                Dienos Vieta
                            </span>
                        </div>
                    </div>
                    <div class="p-8 md:p-12 flex flex-col justify-center">
                        <h3 class="text-4xl md:text-5xl font-bold text-white mb-6">
                            Nidos kopos
                        </h3>
                        <p class="text-lg text-amber-50 leading-relaxed mb-8"> <!--amber text color? !-->
                            Atraskite Parnidžio kopą Nidoje – vieną įspūdingiausių vietų Kuršių nerijoje, kur smėlis ir marios susitinka su dangumi, o saulės laikrodis skaičiuoja nepamirštamas akimirkas.
                        </p>
                        <div>
                            <a href="#" class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-full bg-white text-forest-green hover:bg-amber-50 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                Žiūrėti Daugiau
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Community Stories Section -->
    <div class="py-20 bg-gradient-to-br from-gray-50 to-amber-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-forest-green mb-6">
                    Jūsų Atrasta Lietuva
                </h2>
                <p class="mt-6 max-w-3xl mx-auto text-xl text-gray-700 leading-relaxed">
                    Šis gidas yra kuriamas keliautojų. Pasidalinkite savo nuotykiais, patarimais ir atraskite kitų bendruomenės narių istorijas apie nepamirštamas keliones po mūsų šalį.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="#" class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-full bg-forest-green text-white hover:bg-forest-green/90 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Skaityti Istorijas
                    </a>
                    <a href="#" class="inline-flex items-center px-8 py-4 text-lg font-semibold rounded-full bg-white text-forest-green border-2 border-forest-green hover:bg-forest-green hover:text-white transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Dalintis Savo Istorija
                    </a>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="mt-20 grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Atraskite Vietas</h3>
                    <p class="text-gray-600">Naršykite po šimtus įdomių vietų visoje Lietuvoje</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="w-14 h-14 bg-baltic-blue/10 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-baltic-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Bendruomenė</h3>
                    <p class="text-gray-600">Dalinkitės patirtimi su kitais keliautojais</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="w-14 h-14 bg-forest-green/10 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-forest-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Patikimi Atsiliepimai</h3>
                    <p class="text-gray-600">Skaitykite autentiškus keliautojų atsiliepimus</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-forest-green text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h3 class="text-2xl font-bold mb-2">Aplink Lietuvą</h3>
                <p class="text-amber-100">Atraskite Lietuvos grožį kartu su mumis</p>
                <div class="mt-6 text-amber-100/80 text-sm">
                    © {{ date('Y') }} Aplink Lietuvą. Visos teisės saugomos.
                </div>
            </div>
        </div>
    </footer>
</x-app-layout>