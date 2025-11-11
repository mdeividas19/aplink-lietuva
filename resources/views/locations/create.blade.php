<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="text-3xl font-serif text-center mb-6">Pridėti naują vietovę</h2>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="create-location-form" method="POST" action="{{ route('locations.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium">Pavadinimas</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900">
                        </div>

                        <div>
                            <label for="city_id" class="block text-sm font-medium">Miestas</label>
                            <select name="city_id" id="city_id" class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900" >
                                <option value="">Pasirinkite miestą</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium">Aprašymas</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium">Adresas</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                   class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="latitude" class="block text-sm font-medium">Platuma</label>
                                <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}"
                                       class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900">
                            </div>
                            <div>
                                <label for="longitude" class="block text-sm font-medium">Ilguma</label>
                                <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"
                                       class="mt-1 w-full px-3 py-2 rounded-md border text-gray-900">
                            </div>
                        </div>

                        <div class="text-center my-6">
                            <h2 class="text-2xl mb-6">Pagrindinė nuotrauka</h2>
                            <div id="main-image-preview" class="mt-4 mb-6"></div>
                            <label class="cursor-pointer px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                Pridėti pagrindinę nuotrauką
                                <input type="file" name="main_image" accept="image/*" class="hidden" onchange="previewMainImage(this)">
                            </label>
                        </div>

                        <div class="text-center my-6">
                            <h2 class="text-2xl mb-2">Papildomos nuotraukos</h2>
                            <div id="extra-photos" class="flex flex-wrap gap-4 mt-4"></div>

                            <button type="button" onclick="addExtraPhotoInput()" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 mt-2">
                                Pridėti papildomas nuotraukas
                            </button>
                        </div>

                        <div class="flex justify-between items-center mt-6">
                            <a href="{{ route('locations.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Atgal</a>

                            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Pridėti vietovę
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/locations.js')
</x-app-layout>
