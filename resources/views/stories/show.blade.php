<x-stories-layout>
    <div class="max-w-3xl mx-auto">
        @if($story->cover_image_path)
            @php
                $path = ltrim($story->cover_image_path, '/');
                $coverUrl = Str::startsWith($path, 'demo/')
                    ? asset($path)  // served from /public/demo/... (seedinimui)
                    : asset('storage/'.$path);
            @endphp
            <img src="{{ $coverUrl }}" alt="" class="w-full rounded-2xl mb-6 object-cover">
        @endif

        <h1 class="text-3xl font-serif font-semibold">{{ $story->title }}</h1>
        <div class="text-xs text-stone-500 mt-1 mb-6">
            {{ optional($story->user)->name ?? 'Autorius' }} · {{ $story->created_at->format('Y-m-d') }}
        </div>

        @if($story->tags->count())
            <div class="flex flex-wrap gap-2 mt-2 mb-6">
                @foreach($story->tags as $tag)
                    <span class="px-2 py-0.5 text-xs bg-stone-200 text-stone-700 rounded-full whitespace-nowrap">
                        {{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif

        @php
            $url = urlencode(route('stories.show', $story));
            $text = urlencode($story->title);
        @endphp
        <div class="flex items-center gap-4 mt-4 mb-6">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}"
            target="_blank"
            class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 2 .1v2.2h-1.1c-1.1 0-1.4.7-1.4 1.3V12h2.5l-.4 3h-2.1v7A10 10 0 0 0 22 12z"/>
                </svg>
                Dalintis Facebook
            </a>

            <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $text }}"
            target="_blank"
            class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-black text-white hover:bg-stone-800 transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 1200 1227">
                    <path d="M714 519L1160 0H1017L673 395 429 0H0L461 638 0 1226H143L506 805 771 1226H1200z"/>
                </svg>
                Dalintis X(Twitter)
            </a>
        </div>

        <div
            x-data="{
                liked: {{ auth()->check() && $story->likes()->where('user_id', auth()->id())->exists() ? 'true' : 'false' }},
                likes: {{ $story->likes_count }},
                async toggle() {
                    const res = await fetch('{{ route('stories.like.toggle', $story) }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    if (res.status === 401) {
                        window.location = '{{ route('login') }}';
                        return;
                    }

                    const data = await res.json();
                    this.liked = data.liked;
                    this.likes = data.likes_count;
                }
            }"
            class="flex items-center gap-2 mb-6"
        >
            <button @click="toggle" class="flex items-center gap-1":class="liked ? 'text-rose-600' : 'text-stone-500 hover:text-stone-700'">
                {{-- Outline heart --}}
                <svg x-show="!liked" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.949 0-3.627 1.146-4.312 2.789-.685-1.643-2.363-2.789-4.313-2.789C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                </svg>
                {{-- Filled heart --}}
                <svg x-show="liked" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 3 13.04 3 10.5 3 8.015 5.1 6 7.688 6c1.95 0 3.627 1.146 4.312 2.789C12.685 7.146 14.363 6 16.313 6 18.9 6 21 8.015 21 10.5c0 2.54-1.688 4.86-3.989 6.996a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.218l-.022.012-.007.003-.003.002-.002-.002z"/>
                </svg>
                <span x-text="likes" class="text-sm"></span>
            </button>
        </div>

        <div class="prose prose-stone max-w-none">
            {!! nl2br(e($story->body)) !!}
        </div>

        @if($story->images && $story->images->count())
            <h2 class="text-xl font-serif mt-10 mb-3">Nuotraukų galerija</h2>
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($story->images as $img)
                    @php
                        $gp = ltrim($img->path, '/');
                        $imgUrl = Str::startsWith($gp, 'demo/') ? asset($gp) : asset('storage/'.$gp);
                    @endphp
                    <img src="{{ $imgUrl }}" alt="{{ $img->caption }}" class="rounded-xl w-full aspect-[4/3] object-cover">
                @endforeach
            </div>
        @endif

        <div class="mt-8 flex items-center gap-3">
            @can('edit-story', $story)
                <a href="{{ route('stories.edit', $story) }}" class="px-3 py-2 text-sm rounded-md border border-stone-300">Redaguoti</a>
            @endcan
            @can('delete-story', $story)
                <form method="POST" action="{{ route('stories.destroy', $story) }}" onsubmit="return confirm('Ištrinti istoriją?')">
                    @csrf @method('DELETE')
                    <button class="px-3 py-2 text-sm rounded-md border border-stone-300">Ištrinti</button>
                </form>
            @endcan
        </div>
    </div>

    <div class="max-w-3xl mx-auto mt-12" id="comments">
        <h2 class="text-xl font-serif font-semibold mb-4">Komentarai</h2>

        @auth
            <form method="POST" action="{{ route('stories.comments.store', $story) }}" class="mb-4 space-y-2">
                @csrf
                <textarea name="body" rows="3" class="w-full rounded-lg border p-2"
                        placeholder="Parašykite komentarą..." required>{{ old('body') }}</textarea>
                <div class="flex justify-end">
                    <button class="rounded-lg bg-stone-900 text-white px-3 py-1.5 text-sm">Siųsti</button>
                </div>
            </form>
        @else
            <div class="mb-6 rounded-xl border p-3 text-sm text-stone-600">
                Prisijunkite, kad galėtumėte komentuoti.
            </div>
        @endauth

        @include('stories.comments._list', ['comments' => $comments, 'story' => $story])

        <div class="mt-8">{{ $comments->links() }}</div>
    </div>
</x-stories-layout>
