<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Fields
    </h2>
  </x-slot>
  <div class="container mt-4">
    @if(session())
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3">
      <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M14.354 5.646a.5.5 0 0 0-.708 0L10 9.293 6.354 5.646a.5.5 0 0 0-.708.708L9.293 10l-3.647 3.646a.5.5 0 0 0 .708.708L10 10.707l3.646 3.647a.5.5 0 0 0 .708-.708L10.707 10l3.647-3.646a.5.5 0 0 0 0-.708z" />
      </svg>
    </button>
    @endif

    <a href="{{ route('admin.fields.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-3 ml-2 rounded inline-block">Add
      Field</a>

    <div class="overflow-x-auto">
      <table class="min-w-full w-full bg-white shadow-md border border-gray-200">
        <thead class="bg-gray-800 text-white">
          <tr>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Location</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Image</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Price</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">field_type
            </th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">owner</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Availability</th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($fields as $field)
          <tr>
            <td class="px-4 py-4 whitespace-nowrap">{{ $field->id }}</td>
            <td class="px-4 py-4 whitespace-nowrap">{{ $field->name }}</td>
            <td class="px-4 py-4 whitespace-nowrap">{{ $field->location }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <img src="{{ asset('storage/' . $field->image) }}" alt="{{ $field->name }}" class="h-16 w-16 object-cover rounded">
            </td>
            <td class="px-4 py-4 whitespace-nowrap">${{ $field->price }}.00</td>
            <td class="px-4 py-4 whitespace-nowrap">{{ $field->field_type }}</td>

            <td class="px-4 py-4 whitespace-nowrap">{{ $field->owner_id}}</td>
            <td class="py-2 px-3 border-b border-gray-300">
              <span class="inline-block px-3 py-1 text-white text-xs font-semibold mr-2 rounded-full
                      {{ $field->availablity === 1 ? 'bg-green-500 text-gray-700' : '' }}
                      {{ $field->availablity === 0 ? 'bg-red-500 text-white-300' : '' }}">
                      {{ $field->availablity ? 'Yes' : 'No' }}
              </span>
          </td>
            <td class="px-4 py-4 whitespace-nowrap">
              <a href="{{ route('admin.fields.edit', $field->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded inline-block">
              <i class='bx bx-edit text-sm'></i>
              </a>
              <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded inline-block">  <i class='bx bx-trash text-sm'></i></button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  
</x-app-layout>