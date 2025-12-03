<x-stories-layout>
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-serif mb-6">Nauja istorija</h1>

        <form method="POST" action="{{ route('stories.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Viršelio nuotrauka (thumbnail)</label>
                <input type="file" name="cover" accept="image/*" class="block w-full cursor-pointer">
                <p class="text-xs text-stone-500 mt-1">PNG/JPG, iki 8 MB.</p>
                @error('cover') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Pavadinimas</label>
                <input name="title" value="{{ old('title') }}" required class="w-full rounded-md border p-2">
                @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Turinys</label>
                <textarea name="body" rows="10" required class="w-full rounded-md border p-2">{{ old('body') }}</textarea>
                @error('body') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>


            <label class="block text-sm font-medium mb-1">Žymos</label>
            <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <label class="flex items-center gap-1 text-sm">
                            <input
                                type="checkbox"
                                name="tags[]"
                                value="{{ $tag->id }}"
                                class="rounded border-stone-300"
                            >
                            <span>{{ $tag->name }}</span>
                        </label>
                    @endforeach
            </div>

            @error('tags')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

            <div>
                <label class="block text-sm font-medium mb-1">Galerijos nuotraukos</label>
                <input type="file" name="gallery[]" accept="image/*" multiple class="block w-full cursor-pointer">
                <p class="text-xs text-stone-500 mt-1">Galite pasirinkti kelias nuotraukas.</p>
                @error('gallery.*') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <label class="block text-sm font-medium mb-1">Platuma (latitude)</label>
            <input name="latitude" type="text" class="w-full rounded-md border p-2" value="{{ old('latitude') }}">

            <label class="block text-sm font-medium mb-1 mt-3">Ilguma (longitude)</label>
            <input name="longitude" type="text" class="w-full rounded-md border p-2" value="{{ old('longitude') }}">


            <div class="flex items-center gap-3">
                <button class="px-4 py-2 rounded-md bg-stone-900 text-white">Išsaugoti</button>
                <a href="{{ route('stories.index') }}" class="text-sm text-stone-600 hover:underline">Atšaukti</a>
            </div>
        </form>
    </div>
</x-stories-layout>
