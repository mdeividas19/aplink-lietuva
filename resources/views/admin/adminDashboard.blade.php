<x-app-layout>
    <div class="py-10 bg-gradient-to-b from-baltic-blue-50 via-white to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-5 gap-6">

            {{-- Sidebar --}}
            <div class="col-span-5 md:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg ring-1 ring-amber-100">
                    <div class="p-5">
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-500 mb-3">Valdymas</h3>
                        <nav class="space-y-1">
                            <a class="block rounded-xl px-4 py-3 font-medium text-forest-green-700 bg-forest-green-50 hover:bg-forest-green-100/70 transition">
                                Users
                            </a>
                            <a class="block rounded-xl px-4 py-3 font-medium text-gray-700 hover:bg-amber-50 transition">
                                Comments
                            </a>
                            <a class="block rounded-xl px-4 py-3 font-medium text-gray-700 hover:bg-amber-50 transition">
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
                        <h3 class="text-lg font-bold text-forest-green-700">Users</h3>
                    </div>

                    <div class="p-5 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left text-baltic-blue-800">
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50 rounded-l-lg">ID</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50">Username</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50">Email</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50">Role</th>
                                    <th class="px-4 py-3 font-semibold bg-baltic-blue-50 rounded-r-lg"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($users as $user)
                                <tr class="hover:bg-amber-50">
                                    <td class="px-4 py-3 text-gray-700">{{$user->id}}</td>
                                    <td class="px-4 py-3 text-gray-900 font-medium">{{$user->name}}</td>
                                    <td class="px-4 py-3 text-gray-700">{{$user->email}}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-full bg-forest-green-50 text-forest-green-700 px-2.5 py-0.5 text-xs font-semibold">
                                            {{$user->role}}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a
                                            href='{{ route("admin.editUser", $user->id) }}'
                                            class="inline-flex items-center rounded-xl bg-amber-500 px-3 py-1.5 text-white font-medium hover:bg-amber-600 focus:outline-none focus:ring-4 focus:ring-amber-200 transition"
                                        >
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Optional pill legend --}}
                        <div class="mt-4 text-xs text-gray-500">
                            <span class="inline-flex items-center rounded-full bg-forest-green-50 text-forest-green-700 px-2 py-0.5 font-semibold">Role</span>
                            — skaitinė reikšmė jūsų DB.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
