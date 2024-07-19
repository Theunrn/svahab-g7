<x-app-layout>
    <!-- resources/views/setting/slideshow/index.blade.php -->

    <div class="container mx-auto px-4 py-8">
        <!-- Add New Image Button -->
        <div class="mb-4">
            <button id="openAddModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add New Image
            </button>
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
                            <button data-id="{{ $slideshow->id }}" class="openEditModal text-blue-700 hover:text-blue-500 ">
                                <i class='bx bx-edit text-xl'></i>
                            </button>

                            <!-- Delete Form -->
                            <button onclick="deleteSlideshow('{{ $slideshow->id }}')" class="text-red-600 hover:text-red-900">
                                <i class='bx bx-trash text-xl'></i>
                            </button>
                            <form id="delete-slideshow-{{ $slideshow->id }}" action="{{ route('admin.slideshow.destroy', $slideshow->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
        <div class="p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                        Add New Slide Show Image
                    </h3>
                    <button id="closeAddModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="container mx-auto px-4 py-8">
                    <form action="{{ route('admin.slideshow.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="image" class="block  text-sm font-bold mb-2">Image:</label>
                            <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Add Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
        <div class="p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-black">
                        Edit Slide Show Image
                    </h3>
                    <button id="closeEditModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="container mx-auto px-4 py-8">
                    <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="edit_image" class="block text-sm font-bold mb-2">Image:</label>
                            <input type="file" name="image" id="edit_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('openAddModal').addEventListener('click', function() {
            document.getElementById('addModal').classList.remove('hidden');
        });

        document.getElementById('closeAddModal').addEventListener('click', function() {
            document.getElementById('addModal').classList.add('hidden');
        });

        document.querySelectorAll('.openEditModal').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const editForm = document.getElementById('editForm');
                editForm.action = `/admin/slideshow/${id}`;
                document.getElementById('editModal').classList.remove('hidden');
            });
        });

        document.getElementById('closeEditModal').addEventListener('click', function() {
            document.getElementById('editModal').classList.add('hidden');
        });
        function deleteSlideshow(slideshowId) {
            Swal.fire({
                title: '<span style="color: #d33; font-weight: bold;">Are you sure?</span>',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<span style="font-weight: bold;">Yes, delete it!</span>',
                cancelButtonText: '<span style="font-weight: bold;">Cancel</span>',
                background: '#f7f7f7',
                customClass: {
                    popup: 'border-2 border-gray-300',
                    confirmButton: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                    cancelButton: 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-slideshow-' + slideshowId).submit();
                }
            });
        }
    </script>
</x-app-layout>
