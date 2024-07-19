<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Fields
      </h2>
  </x-slot>
  <div class="container mt-4">
      @if(session('success'))
      <div class="absolute top-0 right-0 m-4">
          <button type="button" class="px-4 py-3">
              <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path
                      d="M14.354 5.646a.5.5 0 0 0-.708 0L10 9.293 6.354 5.646a.5.5 0 0 0-.708.708L9.293 10l-3.647 3.646a.5.5 0 0 0 .708.708L10 10.707l3.646 3.647a.5.5 0 0 0 .708-.708L10.707 10l3.647-3.646a.5.5 0 0 0 0-.708z" />
              </svg>
          </button>
      </div>
      @endif

      <a href="{{ route('admin.fields.create') }}"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-3 ml-2 rounded inline-block">Add
          Field</a>

      <div class="overflow-x-auto">
          <table class="min-w-full w-full bg-white shadow-md border border-gray-200">
              <thead class="bg-gray-800 text-white">
                  <tr>
                      <th scope="col"
                          class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                      <th scope="col"
                          class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                      <th scope="col"
                          class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Location</th>
                      <th scope="col"
                          class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Image</th>
                      <th scope="col"
                          class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Price</th>
                      <th scope="col"
                          class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">field_type
                      </th>
                      {{-- <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">owner</th> --}}
                      <th scope="col"
                          class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Province</th>
                      <th scope="col"
                          class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                  </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                  @foreach($fields as $field)
                  <tr>
                      <td class="px-4 py-4 whitespace-nowrap">{{ $field->id }}</td>
                      <td class="px-4 py-4 whitespace-nowrap">{{ $field->name }}</td>
                      <td class="px-4 py-4 whitespace-nowrap">{{ $field->location }}</td>
                      <td class="px-6 py-4 whitespace-nowrap">
                          <img src="{{ asset('storage/' . $field->image) }}" alt="{{ $field->name }}"
                              class="h-16 w-16 object-cover rounded">
                      </td>
                      <td class="px-4 py-4 whitespace-nowrap">${{ $field->price }}.00</td>
                      <td class="px-4 py-4 whitespace-nowrap">{{ $field->field_type }}</td>
                      <td class="px-4 py-4 whitespace-nowrap">{{ $field->province}}</td>

                      <td class="px-4 py-4 whitespace-nowrap">
                          <a href="{{ route('admin.fields.edit', $field->id) }}"
                              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded inline-block">
                              <i class='bx bx-edit text-sm'></i>
                          </a>
                          <form id="delete-field-{{ $field->id }}"
                              action="{{ route('admin.fields.destroy', $field->id) }}" method="POST"
                              class="inline-block">
                              @csrf
                              @method('DELETE')
                              <button type="button"
                                  onclick="deleteField('{{ $field->id }}')"
                                  class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded inline-block">
                                  <i class='bx bx-trash text-sm'></i>
                              </button>
                          </form>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>

  <script>
      function deleteField(fieldId) {
          Swal.fire({
              title: '<span style="color: #d33; font-weight: bold;">Are you sure?</span>',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: '<span style="font-weight: bold;">Yes, delete it!</span>',
              cancelButtonText: '<span style="font-weight: bold;">Cancel</span>',
              background: '#f7f7f7',
              customClass: {
                  popup: 'border-2 border-gray-300',
                  confirmButton: 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
                  cancelButton: 'bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded'
              }
          }).then((result) => {
              if (result.isConfirmed) {
                  document.getElementById('delete-field-' + fieldId).submit();
              }
          });
      }
  </script>
</x-app-layout>
