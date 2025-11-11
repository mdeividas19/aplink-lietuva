<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

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
                </div>
            </div>
        </div>
    </div>
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
