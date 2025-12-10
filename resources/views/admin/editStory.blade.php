<x-app-layout>
    <div class="py-12">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
		<div>
<form method="post" action="{{route('admin.updateStory', $story)}}">
			@csrf
			@method('patch')
			<div>
			    <label>Title</label></br>
			    <input type="text" name="title" value="{{$story->title}}" required /></br>
			    <label>Body</label></br>
			    <input type="text" name="body" value="{{$story->body}}" required /></br>
			    <label>Latitude</label></br>
			    <input type="text" name="latitude" value="{{$story->latitude}}" /></br>
			    <label>Longitude</label></br>
			    <input type="text" name="longitude" value="{{$story->longitude}}" /></br>
			</div>
			<br><input class="btn btn-primary" type="submit" value="Save" />

		    </form>
		</div>
	    </div>
	</div>
    </div>
</x-app-layout>

