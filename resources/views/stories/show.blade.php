<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-xl font-semibold">{{ $story->title }}</h1>
                    <div class="text-xs text-gray-500 mt-1 mb-4">
                        {{ optional($story->user)->name ?? 'Autorius' }} · {{ $story->created_at->format('Y-m-d') }}
                    </div>

                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($story->body)) !!}
                    </div>

                    @if(auth()->id() === $story->user_id)
                        <div class="mt-6 flex items-center gap-3">
                            <a href="{{ route('stories.edit', $story) }}"
                               class="px-3 py-2 text-sm rounded-md border border-gray-300 dark:border-gray-700">
                                Redaguoti
                            </a>
                            <form method="POST" action="{{ route('stories.destroy', $story) }}"
                                  onsubmit="return confirm('Ištrinti istoriją?')">
                                @csrf @method('DELETE')
                                <button class="px-3 py-2 text-sm rounded-md border border-gray-300 dark:border-gray-700">
                                    Ištrinti
                                </button>
                            </form>
                            <a href="{{ route('stories.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">Atgal</a>
                        </div>
                    @else
                        <div class="mt-6">
                            <a href="{{ route('stories.index') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:underline">Atgal</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>