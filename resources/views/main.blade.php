<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Sveiki atvykę į Aplink Lietuvą!</h3>
                    <ul class="space-y-2">
                    @foreach($cities as $city)
                        <li>
                            <a href="{{ route('cities.show', $city->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{$city->name}}</a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>