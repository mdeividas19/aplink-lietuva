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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>