<x-stories-layout>
    <div id="map" style="position: fixed; top:0; left:0; width:100vw; height:100vh;"></div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([55.1736, 23.8948], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        var stories = @json($stories);

        stories.forEach(story => {
            var marker = L.marker([story.latitude, story.longitude]).addTo(map);

            var popupContent = `
                <div style="text-align:center; max-width:180px;">
            `;

            if (story.cover) {
                popupContent += `
                    <img src="${story.cover}"
                        alt="${story.title}"
                        style="max-width:150px; max-height:100px; object-fit:cover; border-radius:4px; margin-bottom:6px;">
                `;
            }

            popupContent += `
                    <strong>${story.title}</strong><br>
                    <a href="/stories/${story.id}" style="color:#3b82f6; text-decoration:underline;">
                        Skaityti istoriją
                    </a>
                </div>
            `;

            marker.bindPopup(popupContent);

        });

        window.addEventListener('resize', () => map.invalidateSize());
    </script>
</x-stories-layout>
