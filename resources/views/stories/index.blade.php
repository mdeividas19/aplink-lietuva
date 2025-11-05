<x-stories-layout>
  <div class="space-y-8">
    @if($stories->isEmpty())
      <p class="text-stone-600 text-sm">Nėra istorijų.</p>
    @else
      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($stories as $story)
          <a href="{{ route('stories.show', $story) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-200">
            @if(!empty($story->cover_image_path))
              @php
                  $path = ltrim($story->cover_image_path, '/');
                  $coverUrl = Str::startsWith($path, 'demo/')
                      ? asset($path)  // served from /public/demo/... (seedinimui)
                      : asset('storage/'.$path);
              @endphp
              <img
                  src="{{ $coverUrl }}"
                  alt="Viršelio nuotrauka"
                  class="w-full aspect-[16/10] object-cover"
              >
            @else
              <div class="w-full aspect-[16/10] bg-stone-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="w-10 h-10 opacity-40">
                  <path fill="currentColor" d="M4 7h3l1.2-2h7.6L17 7h3a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2zm8 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/>
                </svg>
              </div>
            @endif

            <div class="p-4">
              <h3 class="font-serif text-xl font-semibold group-hover:underline">
                {{ $story->title }}
              </h3>

              <p class="mt-2 text-sm text-stone-600 line-clamp-2">
                {{ $story->excerpt ?? Str::limit(strip_tags($story->body), 120) }}
              </p>

              <div class="mt-3 text-xs text-stone-500 flex justify-between items-center">
                <span>{{ optional($story->user)->name ?? 'Autorius' }}</span>

                <div class="flex items-center gap-3">
                  <span class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h6m5 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z"/>
                      </svg>
                      {{ $story->comments_count }}
                  </span>
                  <span>{{ $story->created_at->format('Y-m-d') }}</span>
                </div>
<<<<<<< HEAD
              </div>    
=======
              </div>
>>>>>>> aed5057 (fix neuzdarytas tagas)
            </div>
          </a>
        @endforeach
      </div>
      <div class="mt-6">
        {{ $stories->links('vendor.pagination.stories') }}
      </div>
    @endif
  </div>
</x-stories-layout>
