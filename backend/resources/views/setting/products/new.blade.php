<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                        <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                        <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>

                    <!-- Product Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                        <input type="text" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Category Selection -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                        <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Color Selection -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Colors:</label>
                        <div class="mt-1 grid grid-cols-1 gap-2 sm:grid-cols-2">
                            @foreach(['Red', 'Black', 'Yellow', 'White', 'Pink', 'Blue'] as $color)
                            <label for="color_{{ strtolower($color) }}" class="inline-flex items-center">
                                <input type="checkbox" id="color_{{ strtolower($color) }}" name="color[]" value="{{ $color }}" class="form-checkbox h-5 w-5 text-{{ strtolower($color) }}-600">
                                <span class="ml-2 text-gray-700">{{ $color }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Size Selection -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Sizes:</label>
                        <div class="mt-1 grid grid-cols-1 gap-2 sm:grid-cols-2">
                            @foreach(['S', 'M', 'L', 'XL', '2XL', '3XL'] as $size)
                            <label for="size_{{ strtolower($size) }}" class="inline-flex items-center">
                                <input type="checkbox" id="size_{{ strtolower($size) }}" name="size[]" value="{{ $size }}" class="form-checkbox h-5 w-5">
                                <span class="ml-2 text-gray-700">{{ $size }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
