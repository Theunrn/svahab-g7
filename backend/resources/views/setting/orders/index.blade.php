<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-semibold text-gray-800">Orders</h2>
                        <form method="GET" action="{{ route('admin.orders.index') }}">
                            <input type="date" name="date" class="px-4 py-2 border rounded-md" placeholder="Search by date">
                            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">Search</button>
                        </form>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 mt-4">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Product Name</th>
                                <th class="px-4 py-2">Quantity</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Total</th>
                                <th class="px-4 py-2">Order</th>
                                <th class="px-4 py-2">Payment</th>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $index => $order)
                            @foreach($order->products as $product)
                            <tr>
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->pivot->qty }}</td>
                                <td class="px-4 py-2">${{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-2">${{ number_format($product->pivot->qty * $product->price, 2) }}</td>
                                <td class="px-4 py-2">{{ $order->order_status }}</td>
                                <td class="px-4 py-2">{{ $order->payment_status }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($order->order_date)->isoFormat('dddd, D MMMM, YYYY') }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">View</a>
                                    @if($order->order_status == 'pending')
                                    <a href="{{ route('admin.orders.confirm', $order->id) }}" class="px-4 py-2 bg-green-500 text-white rounded-md ml-2">Confirm</a>
                                    <a href="{{ route('admin.orders.cancel', $order->id) }}" class="px-4 py-2 bg-red-500 text-white rounded-md ml-2">Cancel</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>