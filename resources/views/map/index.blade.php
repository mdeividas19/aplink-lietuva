<x-app-layout>
    <div id="map" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 40;"></div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var map = L.map('map').setView([55.1735998, 23.8948016], 8);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors', maxZoom: 19 }).addTo(map);
        
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
        
        window.addEventListener('resize', function() {
            map.invalidateSize();
        });
    </script>
</x-app-layout>