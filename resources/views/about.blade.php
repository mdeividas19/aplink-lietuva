<x-app-layout>
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-forest-green to-baltic-blue py-24">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('/img/imgApie.jpg'); background-size: cover; background-position: center;"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
                Apie Mus
            </h1>
            <p class="text-xl md:text-2xl text-amber-100 max-w-3xl mx-auto">
                Jūsų patikimas kelionių gidas po nuostabią Lietuvą
            </p>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-block px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-semibold mb-4">
                        Mūsų Misija
                    </span>
                    <h2 class="text-4xl font-bold text-forest-green mb-6">
                        Sveiki atvykę!
                    </h2>
                    <p class="text-lg text-gray-700 leading-relaxed mb-6">
                        "Aplink Lietuvą" yra projektas sukurtas padėti žmonėms pažinti Lietuvos kraštą. Čia galite sužinoti daugiau apie Lietuvos miestus, lankytinas vietoves, skaityti bei rašyti istorijas, atsiliepimus ir padėti kitiems lankytojams surasti geriausias vietas poilsiauti, pavalgyti, ar tiesiog pamatyti kažką įdomaus.
                    </p>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Mes tikime, kad kiekvienas Lietuvos kampas turi savo unikalią istoriją, kurią verta pasidalinti. Mūsų tikslas – suburti bendruomenę žmonių, kurie myli keliauti ir atrasti naujus nuotykius savo gimtajame krašte.
                    </p>
                </div>
                <div class="relative">
                    <img src="/img/imgApie.jpg" alt="Lietuvos kraštovaizdis" class="rounded-3xl shadow-2xl w-full h-auto">
                    <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-amber-500 rounded-3xl -z-10"></div>
                    <div class="absolute -top-6 -left-6 w-48 h-48 bg-baltic-blue rounded-3xl -z-10"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-forest-green mb-4">
                    Ką Mes Siūlome
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Visą informaciją, kurios jums reikia planuojant keliones po Lietuvą
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Vietovės</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Detalūs aprašymai apie lankytinas vietas, įdomybes ir paslėptus Lietuvos kampelius, kuriuos verta aplankyti.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-baltic-blue to-forest-green rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Istorijos</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Skaitykite kitų keliautojų patirtis, dalinkitės savo nuotykiais ir atraskite įkvepiančias kelionių istorijas.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-forest-green to-moss-green rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Bendruomenė</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Prisijunkite prie aktyvios keliautojų bendruomenės, dalinkitės patarimais ir planuokite keliones kartu.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-forest-green mb-4">
                    Mūsų Vertybės
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Kas mus įkvepia ir veda pirmyn
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tikslas - mūsų šalis</h3>
                    <p class="text-gray-600">Skatiname vietos turizmą ir krašto pažinimą</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-baltic-blue/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-baltic-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Autentiškumas</h3>
                    <p class="text-gray-600">Tik tikros istorijos ir patikima informacija</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-forest-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-forest-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Bendruomeniškumas</h3>
                    <p class="text-gray-600">Kuriame stiprią keliautojų bendruomenę</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-moss-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-moss-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Nuotykis</h3>
                    <p class="text-gray-600">Įkvepiame atrasti naujus horizontus</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-20 bg-gradient-to-br from-forest-green to-baltic-blue">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">
                Prisijunkite prie mūsų bendruomenės
            </h2>
            <p class="text-xl text-amber-100 mb-10 max-w-2xl mx-auto">
                Tapkite dalimi aktyvios keliautojų bendruomenės ir dalinkitės savo patirtimi
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-full bg-amber-500 text-white hover:bg-amber-600 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Registruotis Dabar
                </a>
                <a href="{{ route('contacts') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-full bg-white text-forest-green hover:bg-amber-50 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Susisiekite Su Mumis
                </a>
            </div>
        </div>
    </div>
</x-app-layout>