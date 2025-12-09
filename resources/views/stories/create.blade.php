<x-stories-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl p-4 sm:p-6 md:p-8 border border-stone-200">

            <h1 class="text-2xl sm:text-3xl md:text-4xl font-serif mb-6 sm:mb-8">
                Nauja istorija
            </h1>

            <form method="POST" action="{{ route('stories.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-semibold tracking-wide text-stone-500 mb-2">Viršelio nuotrauka</label>
                    <input type="file" name="cover" accept="image/*" class="w-full rounded-lg border border-stone-300 px-3 py-2 focus:ring-2 focus:ring-stone-500 focus:border-stone-500 transition">
                    <p class="text-xs text-stone-500 mt-1">PNG/JPG, iki 8 MB.</p>
                    @error('cover') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold tracking-wide text-stone-500 mb-2">Pavadinimas</label>
                    <input name="title" value="{{ old('title') }}" required class="w-full rounded-lg border border-stone-300 px-3 py-2 focus:ring-2 focus:ring-stone-500 focus:border-stone-500 transition">
                    @error('title') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold tracking-wide text-stone-500 mb-2">Turinys</label>
                    <textarea name="body" rows="10" required class="w-full rounded-lg border border-stone-300 px-3 py-2 focus:ring-2 focus:ring-stone-500 focus:border-stone-500 transition">{{ old('body') }}</textarea>
                    @error('body') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <label class="flex items-center gap-2 bg-stone-100 hover:bg-stone-200 transition rounded-full px-3 py-1 cursor-pointer">
                    Žymos
                </label>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <label class="flex items-center gap-1 text-sm">
                            <input
                                type="checkbox"
                                name="tags[]"
                                value="{{ $tag->id }}"
                                class="accent-stone-700"
                            >
                            <span>{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>

                @error('tags')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror

                <div>
                    <label class="block text-xs font-semibold tracking-wide text-stone-500 mb-2">Galerijos nuotraukos</label>
                    <input type="file" name="gallery[]" accept="image/*" multiple class="w-full rounded-lg border border-stone-300 px-3 py-2 focus:ring-2 focus:ring-stone-500 focus:border-stone-500 transition">
                    <p class="text-xs text-stone-500 mt-1">Galite pasirinkti kelias nuotraukas.</p>
                    @error('gallery.*') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="p-4 sm:p-5 rounded-xl border border-stone-200 bg-stone-50/60">
                    <h3 class="text-xs font-semibold uppercase tracking-wide text-stone-500 mb-4">
                        Kordinates
                    </h3>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-stone-500 mb-1">Platuma (latitude)</label>
                            <input name="latitude"
                                class="w-full rounded-lg border border-stone-300 px-3 py-2 shadow-sm
                                        focus:ring-2 focus:ring-stone-500"
                                value="{{ old('latitude') }}">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-stone-500 mb-1">Ilguma (longitude)</label>
                            <input name="longitude"
                                class="w-full rounded-lg border border-stone-300 px-3 py-2 shadow-sm
                                        focus:ring-2 focus:ring-stone-500"
                                value="{{ old('longitude') }}">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <button class="px-5 py-2.5 rounded-lg bg-stone-900 text-white shadow hover:bg-stone-800 transition">
                        Išsaugoti
                    </button>
                    <a href="{{ route('stories.index') }}" class="text-stone-600 hover:text-stone-900 underline-offset-2 hover:underline">
                        Atšaukti
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-stories-layout>
