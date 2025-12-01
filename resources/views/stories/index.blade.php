<x-stories-layout>
  <div class="space-y-8">
    @if($stories->isEmpty())
      <p class="text-stone-600 text-sm">Nėra istorijų.</p>
    @else
      <div class="flex justify-end mb-4">
        <form method="GET">
            <select name="sort" class="border rounded-md px-2 pr-8 py-1 text-sm"
                    onchange="this.form.submit()">
                <option value="date" {{ $sort === 'date' ? 'selected' : '' }}>Naujausios</option>
                <option value="likes" {{ $sort === 'likes' ? 'selected' : '' }}>Labiausiai patikusios</option>
                <option value="comments" {{ $sort === 'comments' ? 'selected' : '' }}>Daugiausia komentarų</option>
                <option value="views" {{ $sort === 'views' ? 'selected' : '' }}>Daugiausia peržiūrėta</option>
            </select>
        </form>
      </div>

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

              @if($story->tags->isNotEmpty())
                @if($story->tags->count())
                    <div class="mt-3 flex flex-wrap gap-1.5">

                        @foreach($story->tags->take(3) as $tag)
                            <span class="px-2 py-0.5 text-xs bg-stone-200 text-stone-700 rounded-full whitespace-nowrap">
                                {{ $tag->name }}
                            </span>
                        @endforeach

                        @if($story->tags->count() > 3)
                            <span class="px-2 py-0.5 text-xs bg-stone-300 text-stone-600 rounded-full whitespace-nowrap">
                                +{{ $story->tags->count() - 3 }}
                            </span>
                        @endif

                    </div>
                @endif
              @endif

              <div class="mt-3 text-xs text-stone-500 flex justify-between items-center">
                <span>{{ optional($story->user)->name ?? 'Autorius' }}</span>
                <div class="flex items-center gap-3">
                    <span class="flex items-center gap-1 {{ $story->likes_count > 0 ? 'text-rose-600' : 'text-stone-500' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 3 13.04 3 10.5 3 8.015 5.1 6 7.688 6c1.95 0 3.627 1.146 4.312 2.789C12.685 7.146 14.363 6 16.313 6 18.9 6 21 8.015 21 10.5c0 2.54-1.688 4.86-3.989 6.996a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.218l-.022.012-.007.003-.003.002-.002-.002z"/>
                      </svg>
                      {{ $story->likes_count }}
                    </span>
                    <span class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h6m5 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z"/>
                      </svg>
                      {{ $story->comments_count }}
                    </span>
                    <span class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M2.25 12C3.5 7.5 7.5 4.5 12 4.5s8.5 3 9.75 7.5c-1.25 4.5-5.25 7.5-9.75 7.5s-8.5-3-9.75-7.5zM12 15a3 3 0 100-6 3 3 0 000 6z"/>
                      </svg>
                      {{ $story->views_count }}
                    </span>
                  </div>
              </div>
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
