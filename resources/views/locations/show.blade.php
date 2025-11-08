<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-8 text-center">
                    <h1 class="text-5xl font-serif mb-2 text-forest-green-700">
                        {{ $location->name }}
                    </h1>
                </div>

                <div class="px-8">
                    @if ($location->images && $location->images->count())
                        <div class="relative rounded-lg overflow-hidden shadow-lg">
                            <img
                                class="w-full h-96 object-cover"
                                src="{{ asset('storage/' . $location->images->first()->image_path) }}"
                                alt="Image of {{ $location->name }}"
                            >
                        </div>
                    @endif
                </div>

                @if ($location->images->count() > 1)
                    @php
                        $extraImages = $location->images->skip(1);
                        $visibleImages = $extraImages->take(3);
                        $remainingCount = $extraImages->count() - 3;
                    @endphp

                    <div class="grid grid-cols-4 gap-4 px-8 mt-6">
                        {{-- Show next 3 images normally --}}
                        @foreach($visibleImages as $index => $image)
                            <div class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group hover:shadow-xl transition-shadow" onclick="openGallery({{ $index - 1 }})">
                                <img
                                    class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                                    src="{{ asset('storage/' . $image->image_path) }}"
                                    alt="Image of {{ $location->name }}"
                                >
                            </div>
                        @endforeach

                        @if($remainingCount > 0)
                            @php
                                $fourthImage = $extraImages[4];
                            @endphp
                            <div class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group hover:shadow-xl transition-shadow" onclick="openGallery(3)">
                                <img
                                    class="w-full h-48 object-cover"
                                    src="{{ asset('storage/' . $fourthImage->image_path) }}"
                                    alt="More images"
                                >
                                <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center text-white text-3xl font-bold">
                                    +{{ $remainingCount }}
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 hidden">
                    <button class="absolute top-5 right-5 text-white hover:text-gray-300 text-4xl font-bold" onclick="closeGallery()">×</button>
                    <div class="relative w-[90vw] max-w-6xl h-[80vh]">
                        <img id="galleryImage" class="w-full h-full object-contain rounded shadow-lg">
                        <button class="absolute left-0 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-4xl px-6 py-4 rounded-r-lg" onclick="prevImage()">‹</button>
                        <button class="absolute right-0 top-1/2 -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-4xl px-6 py-4 rounded-l-lg" onclick="nextImage()">›</button>
                    </div>
                </div>

                <div class="mt-12 px-8 pb-8">
                    <h2 class="text-3xl font-serif mb-6 text-forest-green-700 text-center">Aprašymas</h2>
                    
                    @if ($location->description)
                    <div class="prose max-w-none mb-12">
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $location->description }}</p>
                    </div>
                    @endif

                    <h2 class="text-3xl font-serif mb-6 text-forest-green-700 text-center">Vieta</h2>
                    
                    @if ($location->city && $location->address && $location->longitude && $location->latitude)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 max-w-5xl mx-auto">
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition-shadow">
                                <p class="text-sm text-gray-500 mb-1">Miestas</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $location->city->name }}</p>
                            </div>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition-shadow">
                                <p class="text-sm text-gray-500 mb-1">Adresas</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $location->address }}</p>
                            </div>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition-shadow">
                                <p class="text-sm text-gray-500 mb-1">Platuma</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $location->longitude }}</p>
                            </div>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition-shadow">
                                <p class="text-sm text-gray-500 mb-1">Ilguma</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $location->latitude }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const images = [
        @foreach($location->images->skip(1) as $img)
            "{{ asset('storage/' . $img->image_path) }}",
        @endforeach
    ];
    let currentIndex = 0;

    function openGallery(index){
        currentIndex = index;
        document.getElementById('galleryImage').src = images[currentIndex];
        document.getElementById('galleryModal').classList.remove('hidden');
    }

    function closeGallery(){
        document.getElementById('galleryModal').classList.add('hidden');
    }

    function prevImage(){
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        document.getElementById('galleryImage').src = images[currentIndex];
    }

    function nextImage(){
        currentIndex = (currentIndex + 1) % images.length;
        document.getElementById('galleryImage').src = images[currentIndex];
    }
</script>