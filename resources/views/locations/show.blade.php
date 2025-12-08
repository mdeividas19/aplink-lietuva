<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 flex flex-wrap items-center justify-between gap-4">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-forest-green-600 hover:bg-forest-green-700 text-white font-semibold rounded-lg shadow transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Atgal
                    </a>
                    <div class="flex flex-wrap items-center gap-3">
                        @php
                            $url  = urlencode(route('locations.show', $location));
                            $text = urlencode($location->title . ' – ' . config('app.name'));
                        @endphp
                        @auth
                <button type="button"
                        class="heart-btn group p-2.5 bg-white hover:bg-red-50 rounded-full shadow-md hover:shadow-lg hover:scale-110 transition-all duration-200"
                        data-location-id="{{ $location->id }}"
                        data-favorited="{{ auth()->user()->favoriteLocations()->where('location_id', $location->id)->exists() ? '1' : '0' }}">
                    <svg class="w-6 h-6 heart-icon text-red-500" viewBox="0 0 24 24"
                         fill="{{ auth()->user()->favoriteLocations()->where('location_id', $location->id)->exists() ? 'currentColor' : 'none' }}"
                         stroke="currentColor" stroke-width="1.5">
                        <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733C11.597 4.876
                 9.935 3.75 8 3.75 5.411 3.75 3.312 5.765 3.312 8.25c0 7.22 8.688 11.25
                 8.688 11.25s8.688-4.03 8.688-11.25z"
                              stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                        @endauth
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"
                           target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#1877f2] hover:bg-[#166fe5] text-white font-medium text-sm rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 2 .1v2.2h-1.1c-1.1 0-1.4.7-1.4 1.3V12h2.5l-.4 3h-2.1v7A10 10 0 0 0 22 12z"/>
                            </svg>
                            Dalintis Facebook
                        </a>

                        <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $text }}"
                           target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 px-4 py-2.5 bg-black hover:bg-gray-900 text-white font-medium text-sm rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                            Dalintis Twitter
                        </a>
                    </div>
                </div>
                <div class="p-8 text-center">
                    <h1 class="text-5xl font-serif mb-2 text-forest-green-700">
                        {{ $location->name }}
                    </h1>
                </div>

                <div class="px-8">
                    @if ($location->images && $location->images->count())
                        <div class="relative rounded-lg overflow-hidden shadow-lg">
                            <img
                                class="w-full h-96 object-cover"
                                src="{{ asset('storage/' . $location->images->first()->image_path) }}"
                                alt="Image of {{ $location->name }}"
                            >
                        </div>
                    @endif
                </div>

                @if ($location->images->count() > 1)
                    @php
                        $extraImages = $location->images->skip(1);
                        $visibleImages = $extraImages->take(3);
                        $remainingCount = $extraImages->count() - 3;
                    @endphp

                    <div class="grid grid-cols-4 gap-4 px-8 mt-6">
                        @foreach($visibleImages as $index => $image)
                            <div class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group hover:shadow-xl transition-shadow z-40" onclick="openGallery({{ $index - 1 }})">
                                <img
                                    class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                                    src="{{ asset('storage/' . $image->image_path) }}"
                                    alt="Image of {{ $location->name }}"
                                >
                            </div>
                        @endforeach

                        @if($remainingCount > 0)
                            @php
                                $fourthImage = $extraImages[4];
                            @endphp
                            <div class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group hover:shadow-xl transition-shadow z-40" onclick="openGallery(3)">
                                <img
                                    class="w-full h-48 object-cover"
                                    src="{{ asset('storage/' . $fourthImage->image_path) }}"
                                    alt="More images"
                                >
                                <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center text-white text-3xl font-bold">
                                    +{{ $remainingCount - 1 }}
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 hidden">
                    <button class="absolute top-5 right-5 text-white hover:text-gray-300 text-4xl font-bold" onclick="closeGallery()">×</button>
                    <div class="relative w-[90vw] max-w-6xl h-[80vh]">
                        <img id="galleryImage" class="w-full h-full object-contain rounded shadow-lg">
                        <button class="absolute left-0 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-4xl px-6 py-4 rounded-r-lg" onclick="prevImage()">‹</button>
                        <button class="absolute right-0 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-4xl px-6 py-4 rounded-l-lg" onclick="nextImage()">›</button>
                    </div>
                </div>
                <div class="mt-12 px-8 pb-8">
                    @if ($location->description)
                    <h2 class="text-3xl font-serif mb-6 text-forest-green-700 text-center">Aprašymas</h2>

                    <div class="prose max-w-none mb-12">
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $location->description }}</p>
                    </div>
                    @endif
                    @if ($location->address || $location->phone_number)
                    <div class="mb-12 bg-gray-50 rounded-lg p-6">
                        <h2 class="text-3xl font-serif mb-6 text-forest-green-700 text-center">Kontaktai</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">
                            @if ($location->address)
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-forest-green-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Adresas</h3>
                                    <p class="text-gray-700">{{ $location->address }}</p>
                                </div>
                            </div>
                            @endif
                            @if ($location->phone_number)
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-forest-green-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Telefonas</h3>
                                    <a href="tel:{{ $location->phone_number }}" class="text-forest-green-600 hover:text-forest-green-700 hover:underline">{{ $location->phone_number }}</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    @if ($location->city && $location->address && $location->longitude && $location->latitude)
                        <div class=" text-3xl p-7 text-gray-900 text-center dark:text-gray-100">
                            <h1 class="text-4xl font-serif inline-block bg-white text-gray-900 w-[300px] py-1 rounded-full shadow-md">Žemėlapis</h1>
                        </div>
                        <div class=" mb-7 ml-7 mr-7 mt-4 text-gray-900 dark:text-gray-100 ">
                            <div>
                                <div class="z-30" id="map" style="width: 100%; height: 400px; border-radius: 0.5rem;"></div>
                            </div>
                        </div>
                    @endif

                    <div class="mt-8">
    <h2 class="text-xl font-semibold mb-4">Atsiliepimai</h2>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="mb-4 rounded border border-green-200 bg-green-50 px-3 py-2 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Existing reviews --}}
    @if ($location->reviews->count())
        <div class="mb-4 flex items-center gap-2">
            <span class="text-lg font-semibold">
                {{ number_format($location->reviews->avg('rating'), 1) }}/5
            </span>
            <span class="text-sm text-gray-500">
                ({{ $location->reviews->count() }}
                {{ $location->reviews->count() === 1 ? 'atsiliepimas' : 'atsiliepimai' }})
            </span>
        </div>

        <div class="space-y-4 mb-8">
            @foreach ($location->reviews as $review)
                <div class="rounded-lg border border-gray-200 bg-white p-3 shadow-sm">
                    <div class="mb-1 flex items-center justify-between">
                        <div class="text-sm font-semibold">
                            {{ $review->user->name ?? 'Anonimas' }}
                        </div>
                        <div class="text-sm">
                            {{ $review->rating }}/5
                        </div>
                    </div>

                    @if ($review->comment)
                        <p class="text-sm text-gray-700">
                            {{ $review->comment }}
                        </p>
                    @endif

                    <p class="mt-1 text-xs text-gray-400">
                        {{ $review->created_at->diffForHumans() }}
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <p class="mb-6 text-sm text-gray-500">
            Šiuo metu atsiliepimų nėra. Būk pirmas!
        </p>
    @endif

    {{-- New review form --}}
    @auth
        <form action="{{ route('locations.reviews.store', $location) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="rating" class="mb-1 block text-sm font-medium">
                    Įvertinimas
                </label>
                <select id="rating" name="rating"
                        class="w-full rounded border-gray-300 text-sm shadow-sm">
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                            {{ $i }} {{ $i === 1 ? 'žvaigždutė' : 'žvaigždutės' }}
                        </option>
                    @endfor
                </select>
                @error('rating')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="comment" class="mb-1 block text-sm font-medium">
                    Komentaras
                </label>
                <textarea id="comment" name="comment" rows="3"
                          class="w-full rounded border-gray-300 text-sm shadow-sm">{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Pateikti atsiliepimą
            </button>
        </form>
    @else
        <p class="text-sm text-gray-500">
            <a href="{{ route('login') }}" class="text-blue-600 underline">
                Prisijunk
            </a> norėdamas parašyti atsiliepimą.
        </p>
    @endauth
</div>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/locations.js')
</x-app-layout>
<script>
    const images = [
        @foreach($location->images->skip(1) as $img)
            "{{ asset('storage/' . $img->image_path) }}",
        @endforeach
    ];
    let currentIndex = 0;

    function openGallery(index){
        currentIndex = index;
        document.getElementById('galleryImage').src = images[currentIndex];
        document.getElementById('galleryModal').classList.remove('hidden');
        document.body.classList.add('no-scroll')
    }

    function closeGallery(){
        document.getElementById('galleryModal').classList.add('hidden');
    }

    function prevImage(){
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        document.getElementById('galleryImage').src = images[currentIndex];
    }

    function nextImage(){
        currentIndex = (currentIndex + 1) % images.length;
        document.getElementById('galleryImage').src = images[currentIndex];
    }
</script>

<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView(
            [{{ $location->latitude ?? 55.1735998 }}, {{ $location->longitude ?? 23.8948016 }}], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors', maxZoom: 19}).addTo(map);

        var marker = L.marker([{{ $location->latitude ?? 55.1735998 }}, {{ $location->longitude ?? 23.8948016 }}]).addTo(map);
        marker.bindPopup("<b>{{ $location->name }}</b>").openPopup();
    });
</script>
