const searchInput = document.getElementById('locationSearch');
const cityFilter = document.getElementById('cityFilter');

function filterLocations() {
    const query = searchInput.value.toLowerCase().trim();
    const selectedCity = cityFilter.value;

    document.querySelectorAll('.letter-section').forEach(section => {
        let hasVisible = false;

        section.querySelectorAll('.location-card').forEach(card => {
            const name = card.getAttribute('data-name');
            const city = card.getAttribute('data-city');

            const matchesName = query === "" || name.startsWith(query);
            const matchesCity = selectedCity === "" || city === selectedCity;

            if(matchesName && matchesCity) { card.style.display = 'block'; hasVisible = true; }
            else { card.style.display = 'none'; }
        });

        section.style.display = hasVisible ? 'block' : 'none';
    });
}

searchInput.addEventListener('input', filterLocations);
cityFilter.addEventListener('change', filterLocations);
