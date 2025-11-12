<x-app-layout>
    <div class="py-12">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
		<div>
<form method="post" action="{{route('admin.updateUser', $user)}}">
			@csrf
			@method('patch')
			<div>
			    <label>Username</label></br>
			    <input type="text" name="name" value="{{$user->name}}" required />
			</div>
			<div>
			   <label>Role</label></br>
			   <select name="role" value="{{$user->role}}" >
				<option value="0">User</option>
				<option value="1">Verified</option>
				<option value="2">Admin</option>
			   </select>
			</div>

			<br><input class="btn btn-primary" type="submit" value="Save" />

		    </form>
		</div>
	    </div>
	</div>
    </div>
</x-app-layout>

