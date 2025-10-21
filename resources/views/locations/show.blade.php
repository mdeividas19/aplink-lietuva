<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-7 text-gray-900 dark:text-gray-100 text-center">
                    <h1 class="text-4xl font-serif mb-2">{{ $location->name }}</h1>
                </div>
                <hr style="border: 2px solid white;">
                <div class=" text-3xl p-7 text-gray-900 text-center dark:text-gray-100">
                    <h1>Aprašymas</h1>
                </div>
                <div class=" text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col gap-4">
                        @if ($location->description)
                            <p>{{ $location->description }}</p>
                        @else
                            <p>Aprašymas dar nepridėtas.</p>
                        @endif
                    </div>
                </div>
                <div class=" p-4 text-gray-900 dark:text-gray-100"></div>
            </div>
        </div>
    </div>
</x-app-layout>
