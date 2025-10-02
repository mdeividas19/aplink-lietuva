<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Redaguoti istoriją</h3>

                    <form method="POST" action="{{ route('stories.update', $story) }}" class="space-y-4">
                        @csrf @method('PUT')

                        <div>
                            <label class="block text-sm mb-1">Pavadinimas</label>
                            <input name="title" value="{{ old('title', $story->title) }}"
                                   class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" required>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Turinys</label>
                            <textarea name="body" rows="10"
                                      class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100" required>{{ old('body', $story->body) }}</textarea>
                        </div>

                        <div class="flex items-center gap-3">
                            <button class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Išsaugoti</button>
                            <a href="{{ route('stories.show', $story) }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">Atšaukti</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
