<x-app-layout>
    <div class="container mx-auto px-6 py-5">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden md:max-w-2xl">
            <div class="md:flex">
                <div class="p-8">
                    <div class="uppercase tracking-wide text-2xl text-indigo-500 font-semibold mb-5">Order Details</div>
                    <h2 class="block mt-1 text-lg leading-tight font-medium text-black">Customer Name: {{
                        $order->user->name }}</h2>
                    <div class="mt-4">

                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 19.207a7.752 7.752 0 001.415 1.415l2.828-2.829a4.978 4.978 0 01.707-.707L5.12 8.95a2 2 0 010-2.828l1.415-1.414a2 2 0 012.828 0l4.243 4.243a4.978 4.978 0 01.707.707l2.828-2.828a7.752 7.752 0 001.415 1.414l2.828-2.829A2 2 0 0121.121 5.12l-2.829 2.828a4.978 4.978 0 01-.707.707l4.243 4.243a2 2 0 010 2.828l-1.415 1.414a2 2 0 01-2.828 0l-4.243-4.243a4.978 4.978 0 01-.707-.707l-2.828 2.828z">
                                </path>
                            </svg>
                            @if ($order->product)
                            <span class="text-gray-600">Product Name: {{ $order->product->name }}</span>
                            @else
                            <span class="text-gray-600">Product Name: N/A</span> <!-- Or handle accordingly -->
                            @endif

                        </div>
                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 19.207a7.752 7.752 0 001.415 1.415l2.828-2.829a4.978 4.978 0 01.707-.707L5.12 8.95a2 2 0 010-2.828l1.415-1.414a2 2 0 012.828 0l4.243 4.243a4.978 4.978 0 01.707.707l2.828-2.828a7.752 7.752 0 001.415 1.414l2.828-2.829A2 2 0 0121.121 5.12l-2.829 2.828a4.978 4.978 0 01-.707.707l4.243 4.243a2 2 0 010 2.828l-1.415 1.414a2 2 0 01-2.828 0l-4.243-4.243a4.978 4.978 0 01-.707-.707l-2.828 2.828z"></path></svg>
                            @if ($order->pivot)
                                <span class="text-gray-600">Quantity: {{ $order->pivot->qty }}</span>
                            @else
                                <span class="text-gray-600">Quantity: N/A</span> <!-- Handle accordingly -->
                            @endif
                        </div>
                        
                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            @if ($order->pivot)
                                <span class="text-gray-600">Price: ${{ number_format($order->pivot->qty * $order->product->price, 2) }}</span>
                            @else
                                <span class="text-gray-600">Price: N/A</span> <!-- Handle accordingly -->
                            @endif
                        </div>
                        
                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Status:
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $order->order_status === 'comfirmed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->order_status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $order->order_status === 'processing' ? 'bg-blue-100 text-blue-800' : '' }}">
                                    {{ $order->order_status }}
                                </span>
                            </span>
                        </div>
                        <div class="flex items-center mt-2">
                            <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600">Payment Status:
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->payment_status === 'unpaid' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $order->payment_status }}
                                </span>
                            </span>
                        </div>
                        <div>
                            <span>Order Date: {{ \Carbon\Carbon::parse($order->order_date)->isoFormat('dddd, D MMMM,
                                YYYY') }}</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.orders.index') }}"
                            class="bg-indigo-500 hover:bg-indigo-400 text-white font-bold py-1 px-4 border-b-4 border-indigo-700 hover:border-indigo-500 rounded">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>