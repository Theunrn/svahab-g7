<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4 text-sm font-medium">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-sm font-medium">
                <div class="flex items-center justify-between">
                    <div class="ml-5">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2 border-b-2 border-gray-500 inline-block">
                            Create Discount
                        </h2>
                    </div>
                </div>
                <div class="p-3 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.discounts.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Select Product:</label>
                            <select name="product_id" id="product_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="discount" class="block text-gray-700 text-sm font-bold mb-2">Discount Percentage:</label>
                            <input type="number" name="discount" id="discount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Discount</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
