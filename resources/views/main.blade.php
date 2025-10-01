'<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Sveiki atvykę į Aplink Lietuvą!</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('city.show', 'vilnius') }}" 
                               class="text-blue-600 dark:text-blue-400 hover:underline">
                                Vilnius
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('city.show', 'kaunas') }}" 
                               class="text-blue-600 dark:text-blue-400 hover:underline">
                                Kaunas
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('city.show', 'klaipeda') }}" 
                               class="text-blue-600 dark:text-blue-400 hover:underline">
                                Klaipėda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('city.show', 'siauliai') }}" 
                               class="text-blue-600 dark:text-blue-400 hover:underline">
                                Šiauliai
                            </a>
                        </li>
                                                <li>
                            <a href="{{ route('city.show', 'panevezys') }}" 
                               class="text-blue-600 dark:text-blue-400 hover:underline">
                                Panevėžys
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>'