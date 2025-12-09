<x-app-layout>
    <div class="py-8 sm:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">

                    <h2 class="text-2xl sm:text-3xl font-serif text-center mb-5 sm:mb-6">
                        Redaguoti vietovę
                    </h2>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded text-sm">
                            <ul class="list-disc ml-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="update-location-form" method="POST" action="{{ route('locations.update', $location->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-medium">Pavadinimas</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $location->name) }}"
                                   class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900 text-sm sm:text-base" >
                        </div>

                        <div>
                            <label for="city_id" class="block text-sm font-medium">Miestas</label>
                            <select name="city_id" id="city_id"
                                    class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900 text-sm sm:text-base" >
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id', $location->city_id) == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium">Aprašymas</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900 text-sm sm:text-base">{{ old('description', $location->description) }}</textarea>
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium">Adresas</label>
                            <input type="text" name="address" id="address"
                                   value="{{ old('address', $location->address) }}"
                                   class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900 text-sm sm:text-base">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="latitude" class="block text-sm font-medium">Platuma</label>
                                <input type="text" name="latitude" id="latitude"
                                       value="{{ old('latitude', $location->latitude) }}"
                                       class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900 text-sm sm:text-base">
                            </div>
                            <div>
                                <label for="longitude" class="block text-sm font-medium">Ilguma</label>
                                <input type="text" name="longitude" id="longitude"
                                       value="{{ old('longitude', $location->longitude) }}"
                                       class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900 text-sm sm:text-base">
                            </div>
                        </div>

                        @if ($location->firstImage)
                            <div class="text-center mt-4">
                                <h2 class="text-xl sm:text-2xl mb-2">Pagrindinė nuotrauka</h2>
                                <img id="current-first-image"
                                     src="{{ asset('storage/location_images/' . basename($location->firstImage->image_path)) }}"
                                     class="w-full max-h-64 object-cover rounded-md mt-2 border"
                                     alt="Nuotraukos nėra">
                            </div>
                        @endif
                    </form>

                    <div class="text-center my-6">
                        <form id="replace-first-image-form" enctype="multipart/form-data" class="flex flex-col items-center gap-2">
                            @csrf
                            <label class="cursor-pointer px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm sm:text-base">
                                Pakeisti nuotrauką
                                <input type="file" name="image" accept="image/*"  class="hidden"
                                       data-replace-first="{{ route('locations.ReplaceFirstPhoto', $location->id) }}">
                            </label>
                        </form>
                    </div>

                    <hr class="solid-white mt-6 mb-6">

                    <div class="text-center my-6">
                        <h2 class="text-xl sm:text-2xl mb-2">Papildomos nuotraukos</h2>

                        <div id="extra-photos" data-location-id="{{ $location->id }}" class="flex flex-wrap justify-center sm:justify-start gap-3 sm:gap-4 mt-4">
                            @foreach ($location->images->skip(1) as $image)
                                <div class="relative w-40 sm:w-52 h-36 sm:h-48 rounded overflow-hidden border">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                                    <button class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center remove-photo-btn"
                                            data-image-id="{{ $image->id }}">X</button>
                                </div>
                            @endforeach
                        </div>

                        <hr class="solid-white mt-6 mb-6">

                        <form id="add-photo-form" enctype="multipart/form-data" class="flex flex-col items-center gap-2">
                            @csrf
                            <label class="cursor-pointer px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm sm:text-base">
                                Pridėti nuotrauką
                                <input type="file" name="image" accept="image/*"  class="hidden"
                                       data-add-photo="{{ route('locations.AddMorePhotos', $location->id) }}">
                            </label>
                        </form>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center mt-6 gap-3">
                        <a href="{{ route('locations.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 text-center text-sm sm:text-base">
                            Atgal
                        </a>
                        <button form="update-location-form" type="submit"
                                class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm sm:text-base">
                            Atnaujinti vietovę
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/locations.js')
</x-app-layout>
