<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium">Istorijos</h3>
                        @auth
                            <a href="{{ route('stories.create') }}"
                               class="px-3 py-2 text-sm rounded-md bg-blue-600 text-white hover:bg-blue-700">
                                Nauja istorija
                            </a>
                        @endauth
                    </div>

                    @if($stories->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-300">Dar nėra istorijų.</p>
                    @else
                        <ul class="space-y-3">
                            @foreach($stories as $story)
                                <li class="border dark:border-gray-700 rounded-md p-3">
                                    <a href="{{ route('stories.show', $story) }}"
                                       class="font-medium text-blue-600 dark:text-blue-400 hover:underline">
                                        {{ $story->title }}
                                    </a>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ optional($story->user)->name ?? 'Autorius' }} · {{ $story->created_at->format('Y-m-d') }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <div class="mt-6">
                            {{ method_exists($stories,'links') ? $stories->links() : '' }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>