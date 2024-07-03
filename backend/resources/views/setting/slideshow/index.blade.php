<x-app-layout>
    <!-- resources/views/setting/slideshow/index.blade.php -->

    <div class="container mx-auto px-4 py-8">
        <!-- Add New Image Button -->
        <div class="mb-4">
            <a href="{{ route('admin.slideshow.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add New Image
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="text-start px-4">Image</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slideshows as $slideshow)
                    <tr class="border-t">
                        <td class="px-4 py-2">
                            <img src="{{ asset('storage/' . $slideshow->image) }}" alt="Image" class="w-20 h-20 object-cover">
                        </td>
                        <td class="px-4 py-2 text-center">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.slideshow.edit', $slideshow->id) }}" class="text-blue-700 hover:text-blue-500 ">
                                <i class='bx bx-edit text-xl'></i>
                            </a>

                            <!-- Delete Form -->
                            <form action="{{ route('admin.slideshow.destroy', $slideshow->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class='bx bx-trash text-xl'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>