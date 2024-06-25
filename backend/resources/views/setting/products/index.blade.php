<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Products') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
              <div class="flex justify-between items-center mb-4">
                  <h3 class="text-lg font-bold text-gray-800">List of Products</h3>
                  <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add New</a>
              </div>

              @if ($products->isEmpty())
                  <p>No products found.</p>
              @else
                  <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                          <tr>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                          </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                          @foreach ($products as $product)
                              <tr class="hover:bg-gray-100">
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded">
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                                  <td class="px-6 py-4 whitespace-nowrap">{{ $product->description }}</td>
                                  <td class="px-6 py-4 whitespace-nowrap">${{ number_format($product->price, 2) }}</td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      @foreach ($product->color as $color)
                                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ strtolower($color) }}-200 text-{{ strtolower($color) }}-800">{{ $color }}</span>
                                      @endforeach
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                      @foreach ($product->size as $size)
                                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">{{ $size }}</span>
                                      @endforeach
                                  </td>
                                  <td class="px-4 py-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                    </form>
                              </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              @endif
          </div>
      </div>
  </div>
</x-app-layout>
