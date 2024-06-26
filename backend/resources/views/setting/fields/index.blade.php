<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Fields
    </h2>
  </x-slot>

  <div class="container mt-4">
    <a href="{{ route('admin.fields.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md mb-3 hover:bg-blue-600">Add Field</a>
    <div class="overflow-x-auto">
      <table class="table-auto min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 dark:bg-gray-800">
          <tr class="text-left text-gray-700 dark:text-white">
            <th scope="col" class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Field Name</th>
            <th scope="col" class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Location</th>
            <th scope="col" class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Type</th>
            <th scope="col" class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Size</th>
            <th scope="col" class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Players</th>
            <th scope="col" class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Lighting</th>
            <th scope="col" class="px-6 py-3 text-xs font-medium uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($fields as $field)
          <tr class="text-gray-700 dark:text-white">
            <td class="px-6 py-4 whitespace-nowrap">{{ $field->field_name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $field->field_location }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $field->field_type }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $field->field_size }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $field->number_of_players }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $field->lighting_availability ? 'Yes' : 'No' }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <a href="{{ route('admin.fields.edit', $field->id) }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">Edit</a>
              <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-block bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 ml-2">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>
