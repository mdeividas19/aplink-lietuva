<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 m-3 text-gray-900 dark:text-gray-100">
                    <h3 class="text-center text-4xl font-serif mb-3">Sveiki atvykę į vietovių puslapį!</h3>
                    <br>
                    <hr style="border: 2px solid white;">

                    <div class="mt-10 flex flex-col sm:flex-row sm:items-center gap-4">

                        <input type="text" id="locationSearch"
                               placeholder="Ieškoti vietovės..."
                               class="w-full sm:flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900">

                        <select id="cityFilter"
                                class="w-full sm:w-64 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900">
                            <option value="">-</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                @can('isAdmin')
                    <a href="{{ route('locations.create') }}"
                       class="ml-9 mb-3 inline-flex items-center justify-center px-4 py-2 bg-white text-black rounded-lg font-semibold
          border-2 border-transparent hover:border-white hover:bg-gray-700 hover:text-white transition-all duration-200">
                        + Nauja vieta
                    </a>
                @endcan
                <div class="mx-10 text-gray-900 dark:text-gray-100 space-y-8" id="locationsContainer">
                    @foreach($grouped as $letter => $locations)
                        <div class="letter-section" data-letter="{{ $letter }}">
                            <h2 class="text-xl font-bold mb-4 text-white">{{ $letter }}</h2>
                            <div class="flex flex-wrap">
                                @foreach($locations as $location)
                                    <div class="flex flex-col">
                                        <div>
                                    <a href="{{ route('locations.show', $location->id) }}"
                                       class="location-card w-[362px] mr-4 mt-2 block bg-gray-900 dark:bg-gray-700 rounded-lg shadow-md
                                              border-2 border-white overflow-hidden
                                              hover:bg-gray-800 hover:scale-[1.01] transition duration-150 ease-in-out"
                                       data-name="{{ mb_strtolower($location->name, 'UTF-8') }}"
                                       data-city="{{ $location->city_id }}">
                                        @php
                                            $imagePath = $location->firstImage ? $location->firstImage->image_path : null;
                                        @endphp
                                        @if($imagePath)
                                            <img src="{{ asset('storage/location_images/' . basename($imagePath)) }}"
                                                 alt="{{ $location->name }}"
                                                 class="w-full h-40 object-cover border-b-2 border-white">
                                        @else
                                            <div class="w-full h-40 bg-gray-700 flex items-center justify-center text-white">
                                                Nėra nuotraukos
                                            </div>
                                            <hr style="border: 1px solid white;">
                                        @endif
                                        <div class="px-3 py-2 text-center">
                                            <h4 class="text-base font-medium text-white truncate">
                                                {{ $location->name }}
                                            </h4>
                                        </div>
                                    </a>
                                        </div>
                                        @can('isAdmin')
                                            <div class="flex gap-2 mt-2">
                                                <a href="{{ route('locations.edit', $location->id) }}"
                                                   class=" mr-20 inline-flex items-center justify-center w-24 h-10 bg-white text-black rounded-lg font-semibold
          border-2 border-transparent hover:border-white hover:bg-gray-700 hover:text-white transition-all duration-200">
                                                    Redaguoti
                                                </a>
                                                <form action="{{ route('locations.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ml-20 inline-flex items-center w-24 h-10 justify-center px-4 py-2 bg-red-600 text-white rounded-lg font-semibold
                                                    border-2 border-transparent hover:border-white hover:bg-red-900 hover:text-white transition-all duration-200">
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
                    <br><br>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/locations.js')

</x-app-layout>
