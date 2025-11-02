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
            @if(auth()->id() === $story->user_id)
                <a href="{{ route('stories.edit', $story) }}" class="px-3 py-2 text-sm rounded-md border border-stone-300">Redaguoti</a>

                <form method="POST" action="{{ route('stories.destroy', $story) }}" onsubmit="return confirm('Ištrinti istoriją?')">
                    @csrf @method('DELETE')
                    <button class="px-3 py-2 text-sm rounded-md border border-stone-300">Ištrinti</button>
                </form>
            @endif
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