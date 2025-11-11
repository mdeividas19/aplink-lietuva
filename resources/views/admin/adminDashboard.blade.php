<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-5 gap-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-span-1">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Users</h3>
                    <h3 class="text-lg font-medium mb-4">Comments</h3>
                    <h3 class="text-lg font-medium mb-4">Stories</h3>
                </div>
	    </div>
	    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg col-span-4">
		<div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Users</h3>
			<table>
			    <tr>
				<th>ID</th>
				<th>Username</th>
				<th>Email</th>
				<th>Role</th>
			    </tr>
			    @foreach ($users as $user)
			    <tr>
				<td>{{$user->id}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->role}}</td>
				<td><a href='{{route ("admin.editUser", $user->id)}}'>Edit</a></td>
			   </tr>    
			    @endforeach
			</table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

