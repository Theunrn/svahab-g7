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

                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                        <input type="file" name="image" id="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                        <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                        <input type="text" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Colors:</label>
                        <div class="mt-1 grid grid-cols-1 gap-2 sm:grid-cols-2">
                            <label for="color_red" class="inline-flex items-center">
                                <input type="checkbox" id="color_red" name="color[]" value="Red" class="form-checkbox h-5 w-5 text-red-600">
                                <span class="ml-2 text-gray-700">Red</span>
                            </label>
                            <label for="color_black" class="inline-flex items-center">
                                <input type="checkbox" id="color_black" name="color[]" value="Black" class="form-checkbox h-5 w-5 text-gray-900">
                                <span class="ml-2 text-gray-700">Black</span>
                            </label>
                            <label for="color_yellow" class="inline-flex items-center">
                                <input type="checkbox" id="color_yellow" name="color[]" value="Yellow" class="form-checkbox h-5 w-5 text-yellow-500">
                                <span class="ml-2 text-gray-700">Yellow</span>
                            </label>
                            <label for="color_white" class="inline-flex items-center">
                                <input type="checkbox" id="color_white" name="color[]" value="White" class="form-checkbox h-5 w-5 text-white">
                                <span class="ml-2 text-gray-700">White</span>
                            </label>
                            <label for="color_pink" class="inline-flex items-center">
                                <input type="checkbox" id="color_pink" name="color[]" value="Pink" class="form-checkbox h-5 w-5 text-pink-500">
                                <span class="ml-2 text-gray-700">Pink</span>
                            </label>
                            <label for="color_blue" class="inline-flex items-center">
                                <input type="checkbox" id="color_blue" name="color[]" value="Blue" class="form-checkbox h-5 w-5 text-blue-500">
                                <span class="ml-2 text-gray-700">Blue</span>
                            </label>
                            <!-- Add more color options as needed -->
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Sizes:</label>
                        <div class="mt-1 grid grid-cols-1 gap-2 sm:grid-cols-2">
                            <label for="size_s" class="inline-flex items-center">
                                <input type="checkbox" id="size_s" name="size[]" value="S" class="form-checkbox h-5 w-5">
                                <span class="ml-2 text-gray-700">S</span>
                            </label>
                            <label for="size_m" class="inline-flex items-center">
                                <input type="checkbox" id="size_m" name="size[]" value="M" class="form-checkbox h-5 w-5">
                                <span class="ml-2 text-gray-700">M</span>
                            </label>
                            <label for="size_l" class="inline-flex items-center">
                                <input type="checkbox" id="size_l" name="size[]" value="L" class="form-checkbox h-5 w-5">
                                <span class="ml-2 text-gray-700">L</span>
                            </label>
                            <label for="size_xl" class="inline-flex items-center">
                                <input type="checkbox" id="size_xl" name="size[]" value="XL" class="form-checkbox h-5 w-5">
                                <span class="ml-2 text-gray-700">XL</span>
                            </label>
                            <label for="size_2xl" class="inline-flex items-center">
                                <input type="checkbox" id="size_2xl" name="size[]" value="2XL" class="form-checkbox h-5 w-5">
                                <span class="ml-2 text-gray-700">2XL</span>
                            </label>
                            <label for="size_3xl" class="inline-flex items-center">
                                <input type="checkbox" id="size_3xl" name="size[]" value="3XL" class="form-checkbox h-5 w-5">
                                <span class="ml-2 text-gray-700">3XL</span>
                            </label>
                            <!-- Add more size options as needed -->
                        </div>
                    </div>

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
