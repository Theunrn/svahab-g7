<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-4 text-sm font-medium">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-sm font-medium">
                <div class="flex items-center justify-between">
                    <div class="ml-5">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2 border-b-2 border-gray-500 inline-block">
                            Discounts
                        </h2>
                    </div>
                    <div class="mr-5 mt-2">
                        <a href="{{ route('admin.discounts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Discount
                        </a>
                    </div>
                </div>
                <div class="p-3 bg-white border-b border-gray-200">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Title</th>
                                <th class="px-4 py-2 text-left">Discount (%)</th>
                                <th class="px-4 py-2 text-left">Original Price</th>
                                <th class="px-4 py-2 text-left">Discounted Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                                <tr>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $discount->id }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ $discount->title }}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">{{ number_format($discount->discount, 2)}}</td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        @foreach ($discount->products as $product)
                                            <div class="mb-2">
                                                {{ $product->name }} - ${{ number_format($product->price, 2) }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 flex">
                                        @foreach ($discount->products as $product)
                                            <div class="mb-2 flex">
                                                @if ($product->discountedPrice !== null)
                                                    {{ $product->name }} - ${{ number_format($product->discountedPrice, 2) }}
                                                @else
                                                    No discount applied
                                                @endif
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
