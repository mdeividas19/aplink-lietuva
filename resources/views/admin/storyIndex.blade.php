<x-app-layout>
    <div class="py-10 bg-gradient-to-b from-baltic-blue-50 via-white to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-5 gap-6">

            {{-- Sidebar --}}
            <div class="col-span-5 md:col-span-1">
                <div class="bg-white rounded-2xl shadtaasaaow-lg ring-1 ring-amber-100">
                    <div class="p-5">
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-500 mb-3">Valdymas</h3>
                        <nav class="space-y-1">
                            <a href='{{ route("admin.dashboard") }}'class="block rounded-xl px-4 py-3 font-medium text-forest-green-700 bg-forest-green-50 hover:bg-forest-green-100/70 transition">
                                Users
                            </a>
                            <a href='{{ route("admin.reviews") }}' class="block rounded-xl px-4 py-3 font-medium text-gray-700 hover:bg-amber-50 transition">
                               Reviews
                            </a>
                            <a href='{{ route("admin.stories") }}'class="block rounded-xl px-4 py-3 font-medium text-gray-700 hover:bg-amber-50 transition">
                                Stories
                            </a>
                        </nav>
                    </div>
               </div>
            </div>

            {{-- Main card --}}
            <div class="col-span-5 md:col-span-4">
                <div class="bg-white rounded-2xl shadow-lg ring-1 ring-amber-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-forest-green-700">Reviews</h3>
                    </div>

                    <div class="p-5 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left text-baltic-blue-800">
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50 rounded-l-lg">ID</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50">User ID</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50">Title</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50">Body</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50">Latitude</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50">Longitude</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50">Created at</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50 rounded-r-lg"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($stories as $story)
                                <tr class="hover:bg-amber-50">
                                    <td class="px-4 py-3 text-gray-700">{{$story->id}}</td>
                                    <td class="px-4 py-3 text-gray-900 font-medium">{{$story->user_id}}</td>
                                    <td class="px-4 py-3 text-gray-700">{{$story->title}}</td>
                                    <td class="px-4 py-3 text-gray-700">{{$story->body}}</td>
                                    <td class="px-4 py-3 text-gray-700">{{$story->latitude}}</td>
                                    <td class="px-4 py-3 text-gray-700">{{$story->longtitude}}</td>
                                    <td class="px-4 py-3 text-gray-700">{{$story->created_at}}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-full bg-forest-green-50 text-forest-green-700 px-2.5 py-0.5 text-xs font-semibold">
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a
                                            href='{{ route("admin.editStory", $story->id) }}'
                                            class="inline-flex items-center rounded-xl bg-amber-500 px-3 py-1.5 text-white font-medium hover:bg-amber-600 focus:outline-none focus:ring-4 focus:ring-amber-200 transition"
                                        >
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
