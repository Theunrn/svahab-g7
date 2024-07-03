<x-app-layout>
    <!-- resources/views/setting/slideshow/create.blade.php -->

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Add New Slide Show Image</h1>

        <form action="{{ route('admin.slideshow.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Image
                </button>
            </div>
        </form>
    </div>
</x-app-layout>