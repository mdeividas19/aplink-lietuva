document.addEventListener('DOMContentLoaded', () => {
    //filtravimo js
    if (document.getElementById('locationSearch')) {
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

                    const wrapper = card.closest('.flex.flex-col');

                    if (matchesName && matchesCity) {
                        wrapper.style.display = 'flex';
                        hasVisible = true;
                    } else {
                        wrapper.style.display = 'none';
                    }
                });

                section.style.display = hasVisible ? 'block' : 'none';
            });
        }

        searchInput.addEventListener('input', filterLocations);
        cityFilter.addEventListener('change', filterLocations);
    }

    //Vietos kurimo js

    if (document.getElementById('create-location-form')) {

        function previewMainImage(input) {
            const previewDiv = document.getElementById('main-image-preview');
            previewDiv.innerHTML = '';
            if (!input.files[0]) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full max-h-64 object-cover rounded-md border';
                previewDiv.appendChild(img);
            }
            reader.readAsDataURL(input.files[0]);
        }
        window.previewMainImage = previewMainImage;

        function addExtraPhotoInput() {
            const form = document.getElementById('create-location-form');

            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'extra_images[]';
            input.accept = 'image/*';
            input.className = 'hidden';
            input.required = true;
            input.onchange = function() { previewSingleExtraImage(this); }

            form.appendChild(input);
            input.click();
        }
        window.addExtraPhotoInput = addExtraPhotoInput;

        function previewSingleExtraImage(input) {
            if (!input.files[0]) return;

            const container = document.getElementById('extra-photos');
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative w-52 h-48 rounded overflow-hidden border';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <button type="button" class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center" onclick="removeExtraPhoto(this)">X</button>
                `;
                container.appendChild(div);
                div._input = input;
            }
            reader.readAsDataURL(file);
        }

        function removeExtraPhoto(button) {
            const div = button.parentElement;
            if (div._input) div._input.remove();
            div.remove();
        }
        window.removeExtraPhoto = removeExtraPhoto;
    }

    //Vietos redagavimo js

    if (document.getElementById('update-location-form')) {
        //Automatinis pagrindinės nuotraukos pridėjimas
        document.querySelectorAll('input[data-replace-first]').forEach(input => {
            input.addEventListener('change', function() {
                if (!this.files[0]) return;

                const url = this.dataset.replaceFirst;
                const formData = new FormData(this.form);

                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const img = document.querySelector('#current-first-image');
                            if (img) img.src = data.new_image_url + '?t=' + new Date().getTime();
                        }
                    })
                    .catch(err => console.error(err));
            });
        });

        // Automatinis papildomos nuotraukos pridėjimas
        document.querySelectorAll('input[data-add-photo]').forEach(input => {
            input.addEventListener('change', function() {
                if (!this.files[0]) return;

                const url = this.dataset.addPhoto;
                const container = document.getElementById('extra-photos');
                const formData = new FormData(this.form);

                fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && container) {
                            const div = document.createElement('div');
                            div.className = 'relative w-48 h-48 rounded overflow-hidden border';
                            div.innerHTML = `
                        <img src="${data.image_url}" class="w-full h-full object-cover">
                        <button class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center remove-photo-btn"
                                data-image-id="${data.image_id}">X</button>
                    `;
                            container.appendChild(div);
                        }
                    })
                    .catch(err => console.error(err));
            });
        });

        // Išimti nuotraukas
        const extraPhotosContainer = document.getElementById('extra-photos');
        if (extraPhotosContainer) {
            extraPhotosContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-photo-btn')) {
                    const imageId = e.target.getAttribute('data-image-id');
                    const locationId = extraPhotosContainer.dataset.locationId;

                    fetch(`/locations/${locationId}/delete-photo/${imageId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                            'X-HTTP-Method-Override': 'DELETE'
                        }
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) e.target.parentElement.remove();
                        })
                        .catch(err => console.error(err));
                }
            });
        }
    }
    //Pamėgimo mygtuko js
    document.querySelectorAll('.heart-btn').forEach(button => {
        button.addEventListener('click', function () {
            const locationId = this.dataset.locationId;
            let favorited = this.dataset.favorited === '1';
            const method = favorited ? 'DELETE' : 'POST';

            fetch(`/locations/${locationId}/favorite`, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'}}).then(res => {
                    if (res.ok) {
                        favorited = !favorited;
                        this.dataset.favorited = favorited ? '1' : '0';
                        const icon = this.querySelector('.heart-icon');
                        icon.setAttribute('fill', favorited ? 'currentColor' : 'none');

                        if (!favorited) {
                            const card = this.closest('.flex.flex-col.relative');
                            const letterSection = card.closest('.letter-section');
                            card.remove();

                            if (letterSection.querySelectorAll('.flex.flex-col.relative').length === 0) {
                                letterSection.remove();}}}

                    else {console.error('Failed to toggle favorite');}}).catch(err => console.error(err));});
    });
});
