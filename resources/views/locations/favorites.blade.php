<x-app-layout>
    <div data-page="{{ Route::currentRouteName() }}">
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">

                <div class="p-8 text-gray-900">

                    <div class="mt-10 flex flex-col sm:flex-row sm:items-center gap-4">

                        <input type="text" id="locationSearch"
                               placeholder="Ieškoti vietovės..."
                               class="w-full sm:flex-1 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-forest-green-500 focus:border-transparent text-gray-900 bg-white">

                        <select id="cityFilter"
                                class="w-full sm:w-64 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-forest-green-500 focus:border-transparent text-gray-900 bg-white">
                            <option value="">-</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                @can('isAdmin')
                    <div class="px-8 pb-6">
                        <a href="{{ route('locations.create') }}"
                           class="inline-flex items-center justify-center px-6 py-3 bg-amber-500 text-white rounded-lg font-semibold
          hover:bg-amber-600 transition-all duration-200 shadow-md hover:shadow-lg">
                            + Nauja vieta
                        </a>
                    </div>
                @endcan
            </div>

            <div class="space-y-12" id="locationsContainer">
                @foreach($grouped as $letter => $locations)
                    <div class="letter-section" data-letter="{{ $letter }}">
                        <h2 class="text-2xl font-bold mb-6 text-forest-green-700 border-b-2 border-amber-400 pb-2 inline-block">{{ $letter }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($locations as $location)
                                <div class="flex flex-col relative">

                                    @auth
                                        <button type="button"
                                                class="heart-btn absolute top-2 right-2 z-10 bg-white/80 backdrop-blur-sm p-2 rounded-full shadow hover:bg-white transition"
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

                                    <a href="{{ route('locations.show', $location->id) }}"
                                       class="location-card block bg-white rounded-lg shadow-md overflow-hidden
                                              border border-gray-200 hover:shadow-xl hover:scale-[1.02] transition-all duration-200 ease-in-out"
                                       data-name="{{ mb_strtolower($location->name, 'UTF-8') }}"
                                       data-city="{{ $location->city_id }}">
                                        @php
                                            $imagePath = $location->firstImage ? $location->firstImage->image_path : null;
                                        @endphp
                                        @if($imagePath)
                                            <img src="{{ asset('storage/location_images/' . basename($imagePath)) }}"
                                                 alt="{{ $location->name }}"
                                                 class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                                Nėra nuotraukos
                                            </div>
                                        @endif
                                        <div class="px-4 py-4 bg-white">
                                            <h4 class="text-lg font-semibold text-gray-900 truncate">
                                                {{ $location->name }}
                                            </h4>
                                        </div>
                                    </a>
                                    @can('isAdmin')
                                        <div class="flex gap-2 mt-3 px-2">
                                            <a href="{{ route('locations.edit', $location->id) }}"
                                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-forest-green-600 text-white rounded-lg font-semibold text-sm
          hover:bg-forest-green-700 transition-all duration-200">
                                                Redaguoti
                                            </a>
                                            <form action="{{ route('locations.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg font-semibold text-sm
                                                hover:bg-red-700 transition-all duration-200">
                                                    Ištrinti
                                                </button>
                                            </form>
                                        </div>
                                    @endcan
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    @vite('resources/js/locations.js')

</x-app-layout>
