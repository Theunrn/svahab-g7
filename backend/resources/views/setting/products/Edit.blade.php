<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Image Preview -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Current Image:</label>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-32 w-32 object-cover rounded">
                    </div>

                    <!-- Upload New Image -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Update Image:</label>
                        <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                        <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Product Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                        <input type="text" name="price" id="price" value="{{ old('price', $product->price) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Colors -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Colors:</label>
                        <div class="mt-1 grid grid-cols-1 gap-2 sm:grid-cols-2">
                            @foreach(['Red', 'Black', 'Yellow', 'White', 'Pink', 'Blue'] as $color)
                            <label for="color_{{ strtolower($color) }}" class="inline-flex items-center">
                                <input type="checkbox" id="color_{{ strtolower($color) }}" name="color[]" value="{{ $color }}" {{ in_array($color, $product->color) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-{{ strtolower($color) }}-600">
                                <span class="ml-2 text-gray-700">{{ $color }}</span>
                            </label>
                            @endforeach
                            <!-- Add more color options as needed -->
                        </div>
                    </div>

                    <!-- Sizes -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Sizes:</label>
                        <div class="mt-1 grid grid-cols-1 gap-2 sm:grid-cols-2">
                            @foreach(['S', 'M', 'L', 'XL', '2XL', '3XL'] as $size)
                            <label for="size_{{ strtolower($size) }}" class="inline-flex items-center">
                                <input type="checkbox" id="size_{{ strtolower($size) }}" name="size[]" value="{{ $size }}" {{ in_array($size, $product->size) ? 'checked' : '' }} class="form-checkbox h-5 w-5">
                                <span class="ml-2 text-gray-700">{{ $size }}</span>
                            </label>
                            @endforeach
                            <!-- Add more size options as needed -->
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
