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
            <a href="{{ route('stories.index') }}" class="text-sm text-stone-600 hover:underline">Atgal</a>

            @if(auth()->id() === $story->user_id)
                <a href="{{ route('stories.edit', $story) }}" class="px-3 py-2 text-sm rounded-md border border-stone-300">Redaguoti</a>

                <form method="POST" action="{{ route('stories.destroy', $story) }}" onsubmit="return confirm('Ištrinti istoriją?')">
                    @csrf @method('DELETE')
                    <button class="px-3 py-2 text-sm rounded-md border border-stone-300">Ištrinti</button>
                </form>
            @endif
        </div>
    </div>
</x-stories-layout>