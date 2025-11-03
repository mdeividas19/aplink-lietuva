<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-7 text-center">
                    <h1 class="text-4xl font-serif mb-2 inline-block bg-white text-gray-900 w-[700px] py-4 rounded-full shadow-md">
                        {{ $location->name }}
                    </h1>
                </div>

                <div class=" text-center">
                    @if ($location->images && $location->images->count())
                        <div class="relative bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                            <img
                                class="w-full h-96 object-cover border-2 border-white rounded-lg"
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

                    <div class="grid grid-cols-4 gap-4 m-2">
                        {{-- Show next 3 images normally --}}
                        @foreach($visibleImages as $index => $image)
                            <div class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group" onclick="openGallery({{ $index - 1 }})">
                                <img
                                    class="w-full h-48 object-cover"
                                    src="{{ asset('storage/' . $image->image_path) }}"
                                    alt="Image of {{ $location->name }}"
                                >
                            </div>
                        @endforeach

                        @if($remainingCount > 0)
                            @php
                                $fourthImage = $extraImages[4];
                            @endphp
                            <div class="relative overflow-hidden rounded-lg shadow-md cursor-pointer group" onclick="openGallery(3)">
                                <img
                                    class="w-full h-48 object-cover"
                                    src="{{ asset('storage/' . $fourthImage->image_path) }}"
                                    alt="More images"
                                >
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center text-white text-3xl font-bold">
                                    +{{ $remainingCount }}
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr style="border: 1px solid white;">
                @endif

                <div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden">
                    <button class="absolute top-5 right-5 text-white text-3xl font-bold" onclick="closeGallery()">×</button>
                    <div class="relative w-[90vw] max-w-6xl h-[80vh]">
                        <img id="galleryImage" class="w-full h-full object-cover rounded shadow-lg">
                        <button class="absolute left-0 top-1/2 -translate-y-1/2 text-white text-4xl px-4" onclick="prevImage()">‹</button>
                        <button class="absolute right-0 top-1/2 -translate-y-1/2 text-white text-4xl px-4" onclick="nextImage()">›</button>
                    </div>
                </div>

                <div class=" text-3xl p-7 text-gray-900 text-center dark:text-gray-100">
                    <h1 class="text-4xl font-serif mb-2 inline-block bg-white text-gray-900 w-[300px] py-1 rounded-full shadow-md">Aprašymas
                    </h1>
                </div>
                <div class=" text-gray-900 dark:text-gray-100">

                    @if ($location->description)
                    <div class="ml-6 mr-6 flex flex-col gap-4">
                        <p>{{ $location->description }}</p>
                    </div>
                    <hr class="mt-3" style="border: 1px solid white">
                    @endif

                    <div class=" text-3xl p-7 text-gray-900 text-center dark:text-gray-100">
                        <h1 class="text-4xl font-serif mb-2 inline-block bg-white text-gray-900 w-[300px] py-1 rounded-full shadow-md">Vieta</h1>
                    </div>
                    <div class="text-gray-900 dark:text-gray-100">
                            @if ($location->city && $location->address && $location->longitude && $location->latitude)
                                <div class="ml-28 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg pb-8 text-gray-900 dark:text-gray-100 flex gap-4">
                                <p style="display: flex; align-items: center; border: 2px solid white;margin-left: 15px; border-radius: 15px; padding: 5px 20px;">
                                    <span>Miestas</span>
                                    <span style="border-left: 2px solid white; height: 100%; display: inline-block; margin: 0 10px;"></span>
                                    <span>{{ $location->city->name }}</span>
                                </p>
                                <p style="display: flex; align-items: center; border: 2px solid white;margin-left: 15px; border-radius: 15px; padding: 5px 20px;">
                                    <span>Adresas</span>
                                    <span style="border-left: 2px solid white; height: 100%; display: inline-block; margin: 0 10px;"></span>
                                    <span>{{ $location->address }}</span>
                                </p>
                                <p style="display: flex; align-items: center; border: 2px solid white;margin-left: 15px; border-radius: 15px; padding: 5px 20px;">
                                    <span>Platuma</span>
                                    <span style="border-left: 2px solid white; height: 100%; display: inline-block; margin: 0 10px;"></span>
                                    <span>{{ $location->longitude }}</span>
                                </p>
                                <p style="display: flex; align-items: center; border: 2px solid white;margin-left: 15px; border-radius: 15px; padding: 5px 20px;">
                                    <span>Ilguma</span>
                                    <span style="border-left: 2px solid white; height: 100%; display: inline-block; margin: 0 10px;"></span>
                                    <span>{{ $location->latitude }}</span>
                                </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class=" p-4 text-gray-900 dark:text-gray-100"></div>
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
