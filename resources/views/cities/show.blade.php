<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 style="font-size: 2.25rem; font-weight: 600; margin-bottom: 1rem;">{{$city->name}}</h1>
                    <p class="mb-6">{{$city->description}}</p>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 1.5rem;">
                        @if($city->image_1)
                        <div style="width: 100%; height: 192px; border-radius: 0.5rem; overflow: hidden;">
                            <img src="{{ '/img/' . $city->image_1 }}" alt="{{ $city->name }} - Image 1" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif
                        @if($city->image_2)
                        <div style="width: 100%; height: 192px; border-radius: 0.5rem; overflow: hidden;">
                            <img src="{{ '/img/' . $city->image_2 }}" alt="{{ $city->name }} - Image 2" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif
                        @if($city->image_3)
                        <div style="width: 100%; height: 192px; border-radius: 0.5rem; overflow: hidden;">
                            <img src="{{ '/img/' . $city->image_3 }}" alt="{{ $city->name }} - Image 3" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif
                    </div>
                    <div style="margin-top: 2rem;">
                        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">Žemėlapis</h2>
                        <div id="map" style="width: 100%; height: 400px; border-radius: 0.5rem;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([{{ $city->latitude ?? 55.1735998 }}, {{ $city->longitude ?? 23.8948016 }}], 11);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors', maxZoom: 19 }).addTo(map);
        var marker = L.marker([{{ $city->latitude ?? 55.1735998 }}, {{ $city->longitude ?? 23.8948016 }}]).addTo(map);
        marker.bindPopup("<b>{{ $city->name }}</b>");
        var locations = @json($locations);
        locations.forEach(function(location) {
            var marker = L.marker([location.latitude, location.longitude]).addTo(map);
            var popupContent = '<div style="text-align: center;">';
            if (location.image_path) {
                popupContent += '<img src="/storage/location_images/' + location.image_path + '" alt="' + location.name + '" style="max-width: 150px; max-height: 100px; width: auto; height: auto; object-fit: contain; border-radius: 0.25rem; margin-bottom: 0.5rem; display: block; margin-left: auto; margin-right: auto;">';
            }
            popupContent += '<b style="display: block; margin-bottom: 0.25rem;">' + location.name + '</b>' +
                           '<a href="/locations/' + location.id + '" style="color: #3b82f6; text-decoration: underline;">Apie</a>' +
                           '</div>';
            marker.bindPopup(popupContent, {
                maxWidth: 200,
                minWidth: 170
            });
        });
    </script>
</x-app-layout>