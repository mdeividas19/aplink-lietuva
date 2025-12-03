<x-stories-layout>
  <div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-serif mb-6">Redaguoti istoriją</h1>

    <form method="POST" action="{{ route('stories.update', $story) }}" enctype="multipart/form-data" class="space-y-6">
      @csrf @method('PUT')

      <div>
        <label class="block text-sm font-medium mb-2">Viršelio nuotrauka</label>

        @if($story->cover_image_path)
          @php
              $path = ltrim($story->cover_image_path, '/');
              $coverUrl = Str::startsWith($path, 'demo/')
                  ? asset($path)  // served from /public/demo/... (seedinimui)
                  : asset('storage/'.$path);
          @endphp
          <img src="{{ $coverUrl }}" alt="" class="w-full rounded-2xl mb-6 object-cover">
        @endif

        <input type="file" name="cover" accept="image/*" class="block w-full cursor-pointer">
        <p class="text-xs text-stone-500 mt-1">Jei pasirinksite naują, senasis viršelis bus pakeistas. PNG/JPG, iki 8 MB.</p>
        @error('cover') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Pavadinimas</label>
        <input name="title" value="{{ old('title', $story->title) }}" required class="w-full rounded-md border p-2">
        @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Turinys</label>
        <textarea name="body" rows="10" required class="w-full rounded-md border p-2">{{ old('body', $story->body) }}</textarea>
        @error('body') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Žymos</label>

        <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
                <label class="flex items-center gap-1 text-sm">
                    <input
                        type="checkbox"
                        name="tags[]"
                        value="{{ $tag->id }}"
                        @checked(in_array($tag->id, old('tags', $story->tags->pluck('id')->toArray())))
                        class="rounded border-stone-300"
                    >
                    <span>{{ $tag->name }}</span>
                </label>
            @endforeach
        </div>

        @error('tags')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>



      <div>
        <label class="block text-sm font-medium mb-2">Galerija</label>

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
        @else
          <p class="text-sm text-stone-500 mb-2">Šiuo metu nėra papildomų nuotraukų.</p>
        @endif

        <input type="file" name="gallery[]" accept="image/*" multiple class="block w-full cursor-pointer">
        <p class="text-xs text-stone-500 mt-1">Galite pridėti daugiau nuotraukų (kelis failus iš karto).</p>
        @error('gallery.*') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <label class="block text-sm font-medium mb-1">Platuma (latitude)</label>
      <input name="latitude" value="{{ old('latitude', $story->latitude) }}">

      <label class="block text-sm font-medium mb-1 mt-3">Ilguma (longitude)</label>
      <input name="longitude" value="{{ old('longitude', $story->longitude) }}">

      <div class="flex items-center gap-3">
        <button class="px-4 py-2 rounded-md bg-stone-900 text-white">Išsaugoti</button>
        <a href="{{ route('stories.show', $story) }}" class="text-sm text-stone-600 hover:underline">Atšaukti</a>
      </div>
    </form>
  </div>
</x-stories-layout>
