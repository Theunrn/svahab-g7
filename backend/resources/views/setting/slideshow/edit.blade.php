<x-app-layout>
    <!-- resources/views/admin/slideshows/edit.blade.php -->

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Edit Slide Show Image</h1>

        <form action="{{ route('admin.slideshow.update', $slideshow->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Image</label>
                <input type="file" id="image" name="image" class="border border-gray-300 p-2 w-full">
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Image
                </button>
            </div>
        </form>
    </div>

</x-app-layout>