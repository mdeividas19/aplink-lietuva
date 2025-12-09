<x-app-layout>
    <div class="py-8 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border-2 border-amber-200 text-black overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h1 class="text-3xl sm:text-4xl font-semibold mb-4">
                        {{ $city->name }}
                    </h1>

                    @if($city->description)
                        <p class="mb-6 text-gray-700 leading-relaxed">
                            {{ $city->description }}
                        </p>
                    @endif

                    {{-- Image grid --}}
                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @if($city->image_1)
                            <div class="w-full h-48 rounded-lg overflow-hidden">
                                <img
                                    src="{{ '/img/' . $city->image_1 }}"
                                    alt="{{ $city->name }} - Image 1"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                        @endif

                        @if($city->image_2)
                            <div class="w-full h-48 rounded-lg overflow-hidden">
                                <img
                                    src="{{ '/img/' . $city->image_2 }}"
                                    alt="{{ $city->name }} - Image 2"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                        @endif

                        @if($city->image_3)
                            <div class="w-full h-48 rounded-lg overflow-hidden">
                                <img
                                    src="{{ '/img/' . $city->image_3 }}"
                                    alt="{{ $city->name }} - Image 3"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                        @endif
                    </div>

                    {{-- Map --}}
                    <div class="mt-10">
                        <h2 class="text-2xl font-semibold mb-3">
                            Žemėlapis
                        </h2>
                        <div id="map" class="w-full h-80 rounded-lg shadow-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Leaflet CSS & JS --}}
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
                [{{ $city->latitude ?? 55.1735998 }}, {{ $city->longitude ?? 23.8948016 }}],
                11
            );

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);

            var mainMarker = L.marker(
                [{{ $city->latitude ?? 55.1735998 }}, {{ $city->longitude ?? 23.8948016 }}]
            ).addTo(map);

            mainMarker.bindPopup("<b>{{ $city->name }}</b>");

            var locations = @json($locations);

            locations.forEach(function (location) {
                if (!location.latitude || !location.longitude) return;

                var marker = L.marker([location.latitude, location.longitude]).addTo(map);

                var popupContent = '<div style="text-align: center;">';

                if (location.image_path) {
                    popupContent +=
                        '<img src="/storage/location_images/' + location.image_path + '" alt="' + location.name + '"' +
                        ' style="max-width: 150px; max-height: 100px; width: auto; height: auto;' +
                        ' object-fit: contain; border-radius: 0.25rem; margin-bottom: 0.5rem; display: block; margin-left: auto; margin-right: auto;">';
                }

                popupContent +=
                    '<b style="display: block; margin-bottom: 0.25rem;">' + location.name + '</b>' +
                    '<a href="/locations/' + location.id + '" style="color: #3b82f6; text-decoration: underline;">Apie</a>' +
                    '</div>';

                marker.bindPopup(popupContent, {
                    maxWidth: 200,
                    minWidth: 170
                });
            });
        });
    </script>
</x-app-layout>
