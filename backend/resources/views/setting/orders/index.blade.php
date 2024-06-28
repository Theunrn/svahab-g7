<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="ml-5">
                      <h2 class="text-2xl font-semibold text-gray-800 mb-2 border-b-2 border-gray-500 inline-block">
                        Orders
                      </h2>
                    </div>
                    <form class="flex items-center my-1 mr-5 mt-2 shadow-sm" method="GET" action="{{ route('admin.orders.index') }}">
                      <div class="relative flex items-center border border-gray-300 rounded-md shadow-sm">
                        <input class="block w-full px-4 py-2 rounded-md text-gray-700 placeholder-gray-400 bg-white border-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" type="date" name="date" placeholder="Search by day" aria-label="Search">
                        <button class="inline-flex items-center px-4 py-2 text-white bg-blue-500 border border-blue-500 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" type="submit">
                          <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                          </svg>
                          Search
                        </button>
                      </div>
                    </form>
                  </div>                  
                <div class="p-6 bg-white border-b border-gray-200">                   
                    @if ($orders->isEmpty())
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 text-left">Order ID</th>
                                <th class="px-4 py-2 text-left">Product Name</th>
                                <th class="px-4 py-2 text-left">Quantity</th>
                                <th class="px-4 py-2 text-left">Price</th>
                                <th class="px-4 py-2 text-left">Total</th>
                                <th class="px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    @else
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 text-left">Order ID</th>
                                    <th class="px-4 py-2 text-left">Product Name</th>
                                    <th class="px-4 py-2 text-left">Quantity</th>
                                    <th class="px-4 py-2 text-left">Price</th>
                                    <th class="px-4 py-2 text-left">Total</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @foreach($order->products as $product)
                                        <tr class="border-b">
                                            <td class="px-4 py-2">{{ $order->id }}</td>
                                            <td class="px-4 py-2">{{ $product->name }}</td>
                                            <td class="px-4 py-2">{{ $product->pivot->qty }}</td>
                                            <td class="px-4 py-2">${{ number_format($product->price, 2) }}</td>
                                            <td class="px-4 py-2">${{ number_format($product->pivot->qty * $product->price, 2) }}</td>
                                            <td class="px-4 py-2">
                                                @if ($order->status === 'cancelled')
                                                    <span class="text-red-500  flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                        Cancel
                                                    </span>
                                                @else
                                                    <span class="text-green-500 flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        Active
                                                    </span>
                                                @endif
                                            </td>                                                                                                                   
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
