<x-app-layout>
    <div class="py-12">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
		<div>
<form method="post" action="{{route('admin.updateReview', $review)}}">
			@csrf
			@method('patch')
			<div>
			    <label>Comment</label></br>
			    <input type="text" name="comment" value="{{$review->comment}}" required />
			</div>
			<br><input class="btn btn-primary" type="submit" value="Save" />

		    </form>
		</div>
	    </div>
	</div>
    </div>
</x-app-layout>

